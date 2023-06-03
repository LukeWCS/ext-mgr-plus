<?php
/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

namespace lukewcs\extmgrplus\core;

class ext_mgr_plus
{
	const CHECKBOX_MODE_OFF		= 0;
	const CHECKBOX_MODE_ALL		= 1;
	const CHECKBOX_MODE_LAST	= 2;

	protected $common;
	protected $ext_manager;
	protected $cache;
	protected $request;
	protected $log;
	protected $user;
	protected $config;
	protected $config_text;
	protected $language;
	protected $template;
	protected $db;
	protected $table_prefix;
	protected $phpbb_root_path;
	protected $php_ext;

	protected $u_action;
	protected $metadata;
	protected $migrations_db;
	protected $safe_time_limit;

	public function __construct(
		$common,
		\phpbb\extension\manager $ext_manager,
		\phpbb\cache\driver\driver_interface $cache,
		\phpbb\request\request $request,
		\phpbb\log\log $log,
		\phpbb\user $user,
		\phpbb\config\config $config,
		\phpbb\config\db_text $config_text,
		\phpbb\language\language $language,
		\phpbb\template\template $template,
		\phpbb\db\driver\driver_interface $db,
		$table_prefix,
		$phpbb_root_path,
		$php_ext
	)
	{
		$this->common			= $common;
		$this->ext_manager		= $ext_manager;
		$this->cache			= $cache;
		$this->request			= $request;
		$this->log				= $log;
		$this->user				= $user;
		$this->config			= $config;
		$this->config_text		= $config_text;
		$this->language			= $language;
		$this->template			= $template;
		$this->db				= $db;
		$this->table_prefix 	= $table_prefix;
		$this->phpbb_root_path	= $phpbb_root_path;
		$this->php_ext			= $php_ext;
	}

	public function todo(): void
	{
		if (!$this->config['extmgrplus_exec_todo'])
		{
			return;
		}

		if ($this->common->config_text_get('extmgrplus_todo', 'self_disable'))
		{
			$this->common->config_text_set('extmgrplus_todo', 'self_disable', null);

			while ($this->ext_manager->disable_step('lukewcs/extmgrplus'))
			{
			}
		}

		// Not needed with phpBB >=3.3.8-rc1: https://github.com/phpbb/phpbb/pull/6359
		if ($this->common->config_text_get('extmgrplus_todo', 'purge_cache'))
		{
			$this->common->config_text_set('extmgrplus_todo', 'purge_cache', null);

			$this->cache->purge();
		}

		if ($this->common->config_text_get('extmgrplus_todo', 'add_log'))
		{
			$last_job = $this->common->config_text_get('extmgrplus_todo', 'add_log');
			$this->common->config_text_set('extmgrplus_todo', 'add_log', null);

			if ($last_job !== null)
			{
				$this->log->add(
					'admin',
					$last_job['user_id'],
					$last_job['user_ip'],
					$last_job['log_lang_var'],
					$last_job['timestamp'],
					[
						$last_job['ext_count_success'],
						$last_job['ext_count_total'],
					]
				);
			}
		}

		$this->config->set('extmgrplus_exec_todo', ($this->config_text->get('extmgrplus_todo') != '') ? 1 : 0);
	}

	public function ext_manager_before($event): void
	{
		if ($this->ext_manager->is_disabled('lukewcs/extmgrplus') || $event['action'] != 'list')
		{
			return;
		}

		$this->u_action = $event['u_action'];
		$this->language->add_lang(['acp_ext_mgr_plus', 'acp_ext_mgr_plus_lang_author'], 'lukewcs/extmgrplus');
		$this->safe_time_limit = $event['safe_time_limit'];

		$this->common->set_this(
			$this->u_action
		);
		$this->common->set_template_vars('EXTMGRPLUS');

		add_form_key('lukewcs_extmgrplus');

		if ($this->request->is_set_post('extmgrplus_enable_all') || $this->request->is_set_post('extmgrplus_disable_all'))
		{
			$this->common->check_form_key_error('lukewcs_extmgrplus');

			$this->exts_switch_confirm();
		}
		else if ($this->request->is_set_post('extmgrplus_save_order_and_ignore') && $this->config['extmgrplus_switch_order_and_ignore'])
		{
			$this->common->check_form_key_error('lukewcs_extmgrplus');

			$order_list = $this->request->variable('ext_order', ['' => '']);
			$ignore_list = $this->request->variable('ext_ignore', ['']);

			$order_list = preg_grep('/^[0-9]{1,2}$/', $order_list);

			$this->common->config_text_set('extmgrplus_list_order_and_ignore', 'order', count($order_list) ? $order_list : null);
			$this->common->config_text_set('extmgrplus_list_order_and_ignore', 'ignore', count($ignore_list) ? $ignore_list : null);

			$this->common->trigger_error_($this->language->lang('EXTMGRPLUS_MSG_ORDER_AND_IGNORE_SAVED'), E_USER_NOTICE, 'RETURN_TO_EXTENSION_LIST');
		}
		else if ($this->request->is_set_post('extmgrplus_save_checkboxes') && $this->config['extmgrplus_select_checkbox_mode'] == self::CHECKBOX_MODE_LAST)
		{
			$this->common->check_form_key_error('lukewcs_extmgrplus');

			$ext_mark_enabled	= $this->request->variable('ext_mark_enabled', ['']);
			$ext_mark_disabled	= $this->request->variable('ext_mark_disabled', ['']);
			$ext_mark_list		= array_merge($ext_mark_enabled, $ext_mark_disabled);

			$this->common->config_text_set('extmgrplus_list_selected', 'selected', count($ext_mark_list) ? $ext_mark_list : null);

			$this->common->trigger_error_($this->language->lang('EXTMGRPLUS_MSG_CHECKBOXES_SAVED'), E_USER_NOTICE, 'RETURN_TO_EXTENSION_LIST');
		}
	}

	public function ext_manager_after($event): void
	{
		if ($this->ext_manager->is_disabled('lukewcs/extmgrplus'))
		{
			return;
		}
		else if ($event['action'] == 'details')
		{
			$this->versioncheck_save($event['ext_name']);
			return;
		}
		else if ($event['action'] != 'list')
		{
			return;
		}

		if ($this->request->variable('versioncheck_force', false))
		{
			$this->versioncheck_save();
		}

		$notes = [];

		$event['tpl_name'] = '@lukewcs_extmgrplus/acp_ext_mgr_plus_acp_ext_list';

		$ext_list_available	= $this->ext_manager->all_available();
		$ext_list_enabled	= $this->ext_manager->all_enabled();
		$ext_list_disabled	= $this->ext_manager->all_disabled();

		if ($this->config['extmgrplus_switch_migration_col'])
		{
			$ext_list_migrations_inactive = $this->get_exts_with_new_migration(array_diff_key($ext_list_available, $ext_list_enabled));
			$ext_list_migrations_disabled = array_intersect_key($ext_list_migrations_inactive, $ext_list_disabled);
		}
		else if (!$this->config['extmgrplus_switch_migrations'])
		{
			$ext_list_migrations_inactive = $this->get_exts_with_new_migration($ext_list_disabled);
			$ext_list_migrations_disabled = $ext_list_migrations_inactive;
		}
		else
		{
			$ext_list_migrations_inactive = [];
		}

		if ($this->config['extmgrplus_switch_order_and_ignore'])
		{
			$config_text		= $this->common->config_text_get('extmgrplus_list_order_and_ignore');
			$ext_list_order		= $config_text['order'] ?? null;
			$ext_list_ignore	= $config_text['ignore'] ?? null;
		}
		if (!isset($ext_list_order) || !is_array($ext_list_order))
		{
			$ext_list_order = [];
		}
		if (isset($ext_list_ignore) && is_array($ext_list_ignore))
		{
			$ext_list_ignore			= array_flip($ext_list_ignore);
			$ext_list_ignore_enabled	= array_intersect_key($ext_list_ignore, $ext_list_enabled);
			$ext_list_ignore_disabled	= array_intersect_key($ext_list_ignore, $ext_list_disabled);
		}
		else
		{
			$ext_list_ignore			= [];
			$ext_list_ignore_enabled	= [];
			$ext_list_ignore_disabled	= [];
		}

		if (!$this->config['extmgrplus_switch_self_disable'])
		{
			$ext_list_ignore_enabled['lukewcs/extmgrplus'] = 0;
		}
		if (!$this->config['extmgrplus_switch_migrations'])
		{
			$ext_list_ignore_disabled = array_merge($ext_list_ignore_disabled, $ext_list_migrations_disabled);
		}

		if ($this->config['extmgrplus_select_checkbox_mode'] == self::CHECKBOX_MODE_LAST)
		{
			$ext_list_selected = $this->common->config_text_get('extmgrplus_list_selected', 'selected');
		}
		if (isset($ext_list_selected) && is_array($ext_list_selected))
		{
			$ext_list_selected					= array_flip($ext_list_selected);
			$ext_list_selected_enabled			= array_intersect_key($ext_list_selected, $ext_list_enabled);
			$ext_list_selected_disabled			= array_intersect_key($ext_list_selected, $ext_list_disabled);
			$ext_list_selected_enabled_clean	= array_diff_key($ext_list_selected_enabled, $ext_list_ignore_enabled);
			$ext_list_selected_disabled_clean	= array_diff_key($ext_list_selected_disabled, $ext_list_ignore_disabled);
		}
		else
		{
			$ext_list_selected					= [];
			$ext_list_selected_enabled_clean	= [];
			$ext_list_selected_disabled_clean	= [];
		}

		$ext_count_available	= count($ext_list_available);
		$ext_count_enabled		= count($ext_list_enabled);
		$ext_count_disabled		= count($ext_list_disabled);

		$lang_outdated_msg = $this->common->lang_ver_check_msg('EXTMGRPLUS_LANG_VER', 'EXTMGRPLUS_MSG_LANGUAGEPACK_OUTDATED');
		if ($lang_outdated_msg)
		{
			$notes[] = $lang_outdated_msg;
		}

		$this->template->assign_vars([
			'EXTMGRPLUS_CDB_VER'						=> vsprintf('%u.%u', explode('.', PHPBB_VERSION)),
			'EXTMGRPLUS_LIST_ORDER'						=> $ext_list_order,
			'EXTMGRPLUS_LIST_IGNORE'					=> $ext_list_ignore,
			'EXTMGRPLUS_LIST_MIGRATIONS_INACTIVE'		=> $ext_list_migrations_inactive,
			'EXTMGRPLUS_LIST_SELECTED'					=> $ext_list_selected,
			'EXTMGRPLUS_LIST_VERSIONCHECK'				=> $this->versioncheck_list(),
			'EXTMGRPLUS_COUNT_AVAILABLE'				=> $ext_count_available,
			'EXTMGRPLUS_COUNT_ENABLED'					=> $ext_count_enabled,
			'EXTMGRPLUS_COUNT_DISABLED'					=> $ext_count_disabled,
			'EXTMGRPLUS_COUNT_NOT_INSTALLED'			=> $ext_count_available - count($this->ext_manager->all_configured()),
			'EXTMGRPLUS_COUNT_ENABLED_CLEAN'			=> $ext_count_enabled - count($ext_list_ignore_enabled),
			'EXTMGRPLUS_COUNT_DISABLED_CLEAN'			=> $ext_count_disabled - count($ext_list_ignore_disabled),
			'EXTMGRPLUS_COUNT_SELECTED_ENABLED_CLEAN'	=> count($ext_list_selected_enabled_clean),
			'EXTMGRPLUS_COUNT_SELECTED_DISABLED_CLEAN'	=> count($ext_list_selected_disabled_clean),
			'EXTMGRPLUS_NOTES'							=> $notes,

			'EXTMGRPLUS_SELECT_CHECKBOX_MODE'			=> $this->config['extmgrplus_select_checkbox_mode'],
			'EXTMGRPLUS_SWITCH_ORDER_AND_IGNORE'		=> $this->config['extmgrplus_switch_order_and_ignore'],
			'EXTMGRPLUS_SWITCH_SELF_DISABLE'			=> $this->config['extmgrplus_switch_self_disable'],
			'EXTMGRPLUS_SWITCH_MIGRATION_COL'			=> $this->config['extmgrplus_switch_migration_col'],
			'EXTMGRPLUS_SWITCH_MIGRATIONS'				=> $this->config['extmgrplus_switch_migrations'],
		]);
	}

	public function catch_message(): void
	{
		$last_action = $this->template->retrieve_var('EXTMGRPLUS_LAST_EMP_ACTION');
		if ($this->ext_manager->is_disabled('lukewcs/extmgrplus') || $last_action == '')
		{
			return;
		}

		$this->template->set_filenames(['body' => '@lukewcs_extmgrplus/acp_ext_mgr_plus_message_body.html']);
		if ($last_action == 'trigger_error')
		{
			return;
		}

		$ext_name			= $this->template->retrieve_var('EXTMGRPLUS_LAST_EXT_NAME');
		$ext_display_name	= $this->template->retrieve_var('EXTMGRPLUS_LAST_EXT_DISPLAY_NAME');
		$ext_version		= $this->template->retrieve_var('EXTMGRPLUS_LAST_EXT_VERSION');
		$message_text		= $this->template->retrieve_var('MESSAGE_TEXT');
		$s_user_notice		= $this->template->retrieve_var('S_USER_NOTICE');
		$s_user_warning		= $this->template->retrieve_var('S_USER_WARNING');
		if (
			$ext_name != ''
			&& $message_text != ''
			&& ($s_user_notice || $s_user_warning)
		)
		{
			$this->template->assign_vars([
				'MESSAGE_TEXT'		=>	sprintf('%1$s<br><br><strong>%2$s %3$s (%4$s)</strong><br><br><em>%5$s</em>%6$s',
											/* 1 */	$this->language->lang('EXTMGRPLUS_MSG_PROCESS_ABORTED', $this->language->lang($last_action)),
											/* 2 */	$ext_display_name,
											/* 3 */	$this->language->lang('EXTMGRPLUS_VERSION_STRING', $ext_version),
											/* 4 */	$ext_name,
											/* 5 */	$message_text,
											/* 6 */	$this->common->back_link('RETURN_TO_EXTENSION_LIST')
										),
				'S_USER_NOTICE'		=>	false,
				'S_USER_WARNING'	=>	true,
			]);
		}
	}

	private function exts_switch_confirm(): void
	{
		$ext_mark_enabled = $this->request->variable('ext_mark_enabled', ['']);
		$ext_mark_disabled = $this->request->variable('ext_mark_disabled', ['']);
		if ($this->config['extmgrplus_select_checkbox_mode'] == self::CHECKBOX_MODE_LAST && !$this->request->is_set_post('confirm_uid'))
		{
			$this->common->config_text_set('extmgrplus_list_selected', 'selected', array_merge($ext_mark_enabled, $ext_mark_disabled));
		}

		if ($this->request->is_set_post('extmgrplus_disable_all'))
		{
			$this->template->assign_var('EXTMGRPLUS_ACTION_EXPLAIN', $this->language->lang('EXTENSION_DISABLE_EXPLAIN'));
			if ($this->config['extmgrplus_switch_confirmation'])
			{
				if (confirm_box(true))
				{
					$this->exts_disable();
				}
				else
				{
					confirm_box(
						false,
						$this->language->lang('EXTMGRPLUS_MSG_CONFIRM_DISABLE', $this->language->lang('EXTMGRPLUS_EXTENSION_PLURAL', count($ext_mark_enabled))) .
							(array_search('lukewcs/extmgrplus', $ext_mark_enabled) !== false ? '<br><br>' . $this->language->lang('EXTMGRPLUS_MSG_SELF_DISABLE') : ''),
						build_hidden_fields([
							'extmgrplus_disable_all'	=> '1',
							'ext_mark_enabled'			=> $ext_mark_enabled,
							'u_action'					=> $this->u_action
						]),
						'@lukewcs_extmgrplus/acp_ext_mgr_plus_confirm_body.html'
					);
				}
			}
			else
			{
				$this->exts_disable();
			}
		}
		else if ($this->request->is_set_post('extmgrplus_enable_all'))
		{
			$this->template->assign_var('EXTMGRPLUS_ACTION_EXPLAIN', $this->language->lang('EXTENSION_ENABLE_EXPLAIN'));
			if ($this->config['extmgrplus_switch_confirmation'])
			{
				if (confirm_box(true))
				{
					$this->exts_enable();
				}
				else
				{
					confirm_box(
						false,
						$this->language->lang('EXTMGRPLUS_MSG_CONFIRM_ENABLE', $this->language->lang('EXTMGRPLUS_EXTENSION_PLURAL', count($ext_mark_disabled))),
						build_hidden_fields([
							'extmgrplus_enable_all'		=> '1',
							'ext_mark_disabled'			=> $ext_mark_disabled,
							'u_action'					=> $this->u_action
						]),
						'@lukewcs_extmgrplus/acp_ext_mgr_plus_confirm_body.html'
					);
				}
			}
			else
			{
				$this->exts_enable();
			}
		}

		redirect($this->u_action);
	}

	private function exts_disable(): void
	{
		$start_time = time();
		$safe_time_exceeded = false;

		$ext_mark_enabled = $this->request->variable('ext_mark_enabled', ['']);
		$ext_list_enabled = array_flip($ext_mark_enabled);
		$ext_count_enabled = count($ext_list_enabled);
		$ext_count_success = 0;

		$this->config->set('extmgrplus_exec_todo', 1);
		if (phpbb_version_compare(PHPBB_VERSION, '3.3.8-rc1', '<'))
		{
			$this->common->config_text_set('extmgrplus_todo', 'purge_cache', true);
		}

		foreach ($ext_list_enabled as $ext_name => $value)
		{
			$ext_metadata = $this->ext_manager->create_extension_metadata_manager($ext_name)->get_metadata('all');
			$ext_display_name = $ext_metadata['extra']['display-name'] ?? '';
			$ext_version = $ext_metadata['version'] ?? '';
			$this->set_last_ext_template_vars('EXTMGRPLUS_ALL_DISABLE', $ext_name, $ext_display_name, $ext_version);

			if ($this->ext_manager->is_enabled($ext_name))
			{
				if ($ext_name != 'lukewcs/extmgrplus')
				{
					while ($this->ext_manager->disable_step($ext_name))
					{
					}
				}
				else if ($this->config['extmgrplus_switch_self_disable'])
				{
					$this->common->config_text_set('extmgrplus_todo', 'self_disable', true);
					$ext_count_success++;
				}
			}

			if ($this->ext_manager->is_disabled($ext_name))
			{
				$ext_count_success++;
			}

			if ($this->config['extmgrplus_switch_log'])
			{
				$this->common->config_text_set('extmgrplus_todo', 'add_log', $this->get_log_data(
					'EXTMGRPLUS_LOG_EXT_DISABLE_ALL',
					$ext_count_success,
					$ext_count_enabled
				));
			}

			if ((time() - $start_time) >= $this->safe_time_limit)
			{
				$safe_time_exceeded = true;
				break;
			}
		}
		$this->set_last_ext_template_vars('');

		if ($safe_time_exceeded)
		{
			$msg_failed = '<br><br><strong>' . $this->language->lang('EXTMGRPLUS_MSG_SAFE_TIME_EXCEEDED', $this->safe_time_limit) . '</strong>';
		}
		$this->common->trigger_error_(
			$this->language->lang('EXTMGRPLUS_MSG_DEACTIVATION', $ext_count_success, $ext_count_enabled) . ($msg_failed ?? ''),
			(($ext_count_success != $ext_count_enabled || $safe_time_exceeded) ? E_USER_WARNING : E_USER_NOTICE),
			'RETURN_TO_EXTENSION_LIST'
		);
	}

	private function exts_enable(): void
	{
		$start_time = time();
		$safe_time_exceeded = false;

		$ext_mark_disabled = $this->request->variable('ext_mark_disabled', ['']);
		$ext_list_disabled = array_flip($ext_mark_disabled);
		$ext_count_disabled = count($ext_list_disabled);
		$ext_count_success = 0;

		$this->config->set('extmgrplus_exec_todo', 1);
		if (phpbb_version_compare(PHPBB_VERSION, '3.3.8-rc1', '<'))
		{
			$this->common->config_text_set('extmgrplus_todo', 'purge_cache', true);
		}

		$ext_list_failed_activation = [];
		$get_failed_msg = function ($display_name, $ext_version, $ext_name, $message)
		{
			return sprintf('<br><br><strong>%1$s %2$s (%3$s)</strong><br><br><em>%4$s</em>',
				/* 1 */	$display_name,
				/* 2 */	$this->language->lang('EXTMGRPLUS_VERSION_STRING', $ext_version),
				/* 3 */	$ext_name,
				/* 4 */	$message
			);
		};

		if ($this->config['extmgrplus_switch_order_and_ignore'])
		{
			$ext_list_order = $this->common->config_text_get('extmgrplus_list_order_and_ignore', 'order');
		}
		if (isset($ext_list_order) && is_array($ext_list_order))
		{
			$ext_list_order = array_intersect_key($ext_list_order, $ext_list_disabled);
			asort($ext_list_order, SORT_NUMERIC);
		}
		else
		{
			$ext_list_order = [];
		}
		$ext_list_disabled = array_merge($ext_list_order, $ext_list_disabled);

		foreach ($ext_list_disabled as $ext_name => $value)
		{
			$ext_metadata = $this->ext_manager->create_extension_metadata_manager($ext_name)->get_metadata('all');
			$ext_display_name = $ext_metadata['extra']['display-name'] ?? '';
			$ext_version = $ext_metadata['version'] ?? '';
			$this->set_last_ext_template_vars('EXTMGRPLUS_ALL_ENABLE', $ext_name, $ext_display_name, $ext_version);

			$is_enableable = $this->ext_manager->get_extension($ext_name)->is_enableable();
			$is_enableable_condition = (phpbb_version_compare(PHPBB_VERSION, '3.3.0-dev', '<')
				? $is_enableable == true
				: $is_enableable === true
			);
			if ($this->ext_manager->is_disabled($ext_name) && $is_enableable_condition)
			{
				try
				{
					while ($this->ext_manager->enable_step($ext_name))
					{
					}
				}
				catch (\phpbb\db\migration\exception $e)
				{
					$msg_failed = $get_failed_msg($ext_display_name, $ext_version, $ext_name, $e->getLocalisedMessage($this->user));
					$this->common->trigger_error_(
						$this->language->lang('EXTMGRPLUS_MSG_PROCESS_ABORTED', $this->language->lang('EXTMGRPLUS_ALL_ENABLE')) . $msg_failed,
						E_USER_WARNING,
						'RETURN_TO_EXTENSION_LIST'
					);
				}
			}

			if ($this->ext_manager->is_enabled($ext_name))
			{
				$ext_count_success++;
			}
			else
			{
				$ext_list_failed_activation[$ext_name] = [
					'display_name'	=> $ext_display_name,
					'ext_version'	=> $ext_version,
					'message'		=> (empty($is_enableable) ? $this->language->lang('EXTENSION_NOT_ENABLEABLE') : $is_enableable),
				];
			}

			if ($this->config['extmgrplus_switch_log'])
			{
				$this->common->config_text_set('extmgrplus_todo', 'add_log', $this->get_log_data(
					'EXTMGRPLUS_LOG_EXT_ENABLE_ALL',
					$ext_count_success,
					$ext_count_disabled
				));
			}

			if ((time() - $start_time) >= $this->safe_time_limit)
			{
				$safe_time_exceeded = true;
				break;
			}
		}

		$this->set_last_ext_template_vars('');

		if ($safe_time_exceeded)
		{
			$msg_failed = '<br><br><strong>' . $this->language->lang('EXTMGRPLUS_MSG_SAFE_TIME_EXCEEDED', $this->safe_time_limit) . '</strong>';
		}
		else if (count($ext_list_failed_activation))
		{
			$msg_failed = '<br><br>' . $this->language->lang('EXTMGRPLUS_MSG_ACTIVATION_FAILED');
			foreach ($ext_list_failed_activation as $name => $vars)
			{
				if (is_array($vars['message']))
				{
					$vars['message'] = implode('<br>', $vars['message']);
				}
				$msg_failed .= $get_failed_msg($vars['display_name'], $vars['ext_version'], $name, $vars['message']);
			}
		}
		$this->common->trigger_error_(
			$this->language->lang('EXTMGRPLUS_MSG_ACTIVATION', $ext_count_success, $ext_count_disabled) . ($msg_failed ?? ''),
			(($ext_count_success != $ext_count_disabled || $safe_time_exceeded) ? E_USER_WARNING : E_USER_NOTICE),
			'RETURN_TO_EXTENSION_LIST'
		);
	}

	// Store information about the current process in template variables
	private function set_last_ext_template_vars(string $action, string $ext_name = '', string $ext_display_name = '', string $ext_version = ''): void
	{
		$this->template->assign_vars([
			'EXTMGRPLUS_LAST_EMP_ACTION'		=> $action,
			'EXTMGRPLUS_LAST_EXT_NAME'			=> $action !== '' ? $ext_name : '',
			'EXTMGRPLUS_LAST_EXT_DISPLAY_NAME'	=> $action !== '' ? $ext_display_name : '',
			'EXTMGRPLUS_LAST_EXT_VERSION'		=> $action !== '' ? $ext_version : '',
		]);
	}

	// Determine all extensions that have new migrations from the passed list of extensions
	private function get_exts_with_new_migration(array $ext_list): array
	{
		$this->load_migrations_db();

		$ext_with_migrations_list = [];
		if ($this->config['extmgrplus_switch_order_and_ignore'])
		{
			$ext_list_ignore = array_flip($this->common->config_text_get('extmgrplus_list_order_and_ignore', 'ignore') ?? []);
		}

		if (isset($this->migrations_db))
		{
			foreach ($ext_list as $ext_name => $ext_path)
			{
				if (isset($ext_list_ignore[$ext_name]))
				{
					continue;
				}
				$migration_files_count = $this->get_new_migrations_count($ext_name, $ext_path);
				if ($migration_files_count)
				{
					$ext_with_migrations_list[$ext_name] = $migration_files_count;
				}
			}
		}
		unset($this->migrations_db);

		return $ext_with_migrations_list;
	}

	// Get the number of new migration files of the specified extension
	private function get_new_migrations_count(string $ext_name, string $ext_path): int
	{
		$migrations_available = $this->ext_manager->get_finder()->extension_directory('/migrations')->find_from_extension($ext_name, $ext_path, false);
		$migration_classes = $this->ext_manager->get_finder()->get_classes_from_files($migrations_available);
		$migration_classes_db = preg_grep('/' . str_replace('/', '\\\\', $ext_name) . '\\\\migrations\\\\/', $this->migrations_db);
		$migration_classes_new = array_diff($migration_classes, $migration_classes_db);

		$migration_files = array_keys($migrations_available);
		foreach ($migration_classes_new as $key => $class)
		{
			if ($this->is_migration($this->phpbb_root_path . $migration_files[$key]) !== 1)
			{
				unset($migration_classes_new[$key]);
			}
		}

		return count($migration_classes_new);
	}

	// Check if file is a valid migration file
	private function is_migration(string $file): int
	{
		$file_info = pathinfo($file);
		if (($file_info['extension'] ?? '') == $this->php_ext && file_exists($file))
		{
			$file_content = file_get_contents($file);
			if ($file_content !== false)
			{
				$check_migration = ((
						preg_match('/function\s+?(?:depends_on|effectively_installed|update_schema|update_data|revert_data)\s*?\(/', $file_content)
						&& preg_match('/^\s*?class\s+?' . $file_info['filename'] . '\s+/m', $file_content)
					)
					? 1
					: 0
				);
			}
		}

		return ($check_migration ?? -1);
	}

	// Load all extension migrations into an array
	private function load_migrations_db(): void
	{
		$this->migrations_db = [];

		$sql = "SELECT migration_name
				FROM " . $this->table_prefix . 'migrations' . "
				WHERE migration_name LIKE '" . $this->db->sql_escape('%\\\\migrations\\\\%') . "'";
		$result = $this->db->sql_query($sql);

		if (!$this->db->get_sql_error_triggered())
		{
			while ($migration = $this->db->sql_fetchrow($result))
			{
				$this->migrations_db[] = $migration['migration_name'];
			}
		}
		$this->db->sql_freeresult($result);
	}

	// Generate a log data package
	private function get_log_data(string $log_lang_var, int $ext_count_success, int $ext_count_total): array
	{
		return [
			'user_id'			=> $this->user->data['user_id'],
			'user_ip'			=> $this->user->ip,
			'log_lang_var'		=> $log_lang_var,
			'timestamp'			=> time(),
			'ext_count_success'	=> $ext_count_success,
			'ext_count_total'	=> $ext_count_total,
		];
	}

	// Writes the cached version check data to the database.
	private function versioncheck_save(string $param_ext_name = ''): void
	{
		if ($param_ext_name != '' && $this->config_text->get('extmgrplus_list_version_check') != '')
		{
			$ext_list_db = $this->common->config_text_get('extmgrplus_list_version_check', 'updates');
		}
		else
		{
			$ext_list_db = [
				'data' => [
					'date' => (($param_ext_name == '') ? time() : null),
				],
			];
		}
		if ($param_ext_name != '')
		{
			$ext_list = [
				$param_ext_name => $this->ext_manager->get_extension_path($param_ext_name, true)
			];
			$ext_list_db_update = false;
		}
		else
		{
			$ext_list = $this->ext_manager->all_available();
			$ext_list_db_update = true;
		}

		foreach ($ext_list as $ext_name => $path)
		{
			$md_manager = $this->ext_manager->create_extension_metadata_manager($ext_name);

			try
			{
				$ext_metadata = $md_manager->get_metadata('all');

				if (isset($ext_metadata['extra']['version-check']))
				{
					$vc_data = $this->ext_manager->version_check($md_manager, false, true);
					if (!empty($vc_data))
					{
						$db_ver = $ext_list_db[$ext_name]['current'] ?? '0.0.0';
						if (phpbb_version_compare($db_ver, $vc_data['current'], '<'))
						{
							$ext_list_db[$ext_name] = [
								'current' => $vc_data['current'],
							];
							$ext_list_db_update = true;
						}
					}
				}
			}
			catch (exception_interface | \RuntimeException $e)
			{
			}
		}
		if ($ext_list_db_update)
		{
			$this->common->config_text_set('extmgrplus_list_version_check', 'updates', $ext_list_db);
		}
	}

	// Reads the version check data from the database and removes obsolete entries and generates a list for the template
	private function versioncheck_list(): array
	{
		$ext_list_db = $this->common->config_text_get('extmgrplus_list_version_check', 'updates');
		if ($ext_list_db === null)
		{
			return [];
		}
		$ext_list_db_update = false;
		$ext_list_tpl = [];

		foreach ($ext_list_db as $ext_name => $ext_data)
		{
			if ($ext_name == 'data')
			{
				continue;
			}
			if ($this->ext_manager->is_available($ext_name))
			{
				$ext_metadata = $this->ext_manager->create_extension_metadata_manager($ext_name)->get_metadata('all');

				if (phpbb_version_compare($ext_metadata['version'], $ext_data['current'], '<'))
				{
					$ext_list_tpl[$ext_name]  = [
						'CURRENT' => $ext_data['current'],
					];
				}
			}
			if (!isset($ext_list_tpl[$ext_name]))
			{
				unset($ext_list_db[$ext_name]);
				$ext_list_db_update = true;
			}
		}
		if ($ext_list_db_update)
		{
			$this->common->config_text_set('extmgrplus_list_version_check', 'updates', $ext_list_db);
		}

		$ext_list_tpl['data'] = [
			'LOCAL_DATE'	=> ($ext_list_db['data']['date'] !== null ? $this->user->format_date($ext_list_db['data']['date']) : null),
			'COUNT'			=> count($ext_list_db) - 1,
		];

		return $ext_list_tpl;
	}
}
