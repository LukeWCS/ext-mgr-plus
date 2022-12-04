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
	protected $extension_manager;
	protected $cache;
	protected $request;
	protected $log;
	protected $user;
	protected $config;
	protected $config_text;
	protected $language;
	protected $template;
	protected $phpbb_container;

	protected $u_action;

	public function __construct(
		\phpbb\extension\manager $ext_manager,
		\phpbb\cache\driver\driver_interface $cache,
		\phpbb\request\request $request,
		\phpbb\log\log $log,
		\phpbb\user $user,
		\phpbb\config\config $config,
		\phpbb\config\db_text $config_text,
		\phpbb\language\language $language,
		\phpbb\template\template $template,
		$phpbb_container
	)
	{
		$this->extension_manager	= $ext_manager;
		$this->cache				= $cache;
		$this->request				= $request;
		$this->log					= $log;
		$this->user					= $user;
		$this->config				= $config;
		$this->config_text			= $config_text;
		$this->language				= $language;
		$this->template				= $template;
		$this->phpbb_container		= $phpbb_container;
	}

	public function todo()
	{
		if ($this->config_text->get('extmgrplus_todo_list') == '')
		{
			return;
		}

		if ($this->config_text_get('extmgrplus_todo_list', 'self_disable'))
		{
			$this->config_text_set('extmgrplus_todo_list', 'self_disable', null);

			while ($this->extension_manager->disable_step('lukewcs/extmgrplus'))
			{
			}
		}

		// Not needed with phpBB >=3.3.8: https://github.com/phpbb/phpbb/pull/6359
		if ($this->config_text_get('extmgrplus_todo_list', 'purge_cache'))
		{
			$this->config_text_set('extmgrplus_todo_list', 'purge_cache', null);
			$this->cache->purge();
		}

		if ($this->config_text_get('extmgrplus_todo_list', 'add_log'))
		{
			$last_job = $this->config_text_get('extmgrplus_todo_list', 'add_log');
			$this->config_text_set('extmgrplus_todo_list', 'add_log', null);

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
	}

	public function ext_manager_before($event)
	{
		if ($event['action'] != 'list' || $this->extension_manager->is_disabled('lukewcs/extmgrplus'))
		{
			return;
		}

		$this->u_action = $event['u_action'];
		$this->language->add_lang('acp_ext_mgr_plus', 'lukewcs/extmgrplus');

		add_form_key('lukewcs_extmgrplus');

		if ($this->request->is_set_post('extmgrplus_enable_all') || $this->request->is_set_post('extmgrplus_disable_all'))
		{
			if (!check_form_key('lukewcs_extmgrplus'))
			{
				trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
			}

			$this->enable_disable_confirm();
		}
		else if ($this->request->is_set_post('extmgrplus_save_settings'))
		{
			if (!check_form_key('lukewcs_extmgrplus'))
			{
				trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
			}

			$this->config->set('extmgrplus_enable_log', $this->request->variable('extmgrplus_enable_log', 0));
			$this->config->set('extmgrplus_enable_confirmation', $this->request->variable('extmgrplus_enable_confirmation', 0));
			$this->config->set('extmgrplus_enable_checkboxes_all_set', $this->request->variable('extmgrplus_enable_checkboxes_all_set', 0));
			$this->config->set('extmgrplus_enable_order_and_ignore', $this->request->variable('extmgrplus_enable_order_and_ignore', 0));
			$this->config->set('extmgrplus_enable_self_disable', $this->request->variable('extmgrplus_enable_self_disable', 0));
			$this->config->set('extmgrplus_enable_migrations', $this->request->variable('extmgrplus_enable_migrations', 0));

			trigger_error($this->language->lang('EXTMGRPLUS_MSG_SETTINGS_SAVED') . adm_back_link($this->u_action), E_USER_NOTICE);
		}
		else if ($this->request->is_set_post('extmgrplus_save_order_and_ignore') && $this->config['extmgrplus_enable_order_and_ignore'])
		{
			if (!check_form_key('lukewcs_extmgrplus'))
			{
				trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
			}

			$order_list = $this->request->variable('ext_order', ['' => '']);
			$ignore_list = $this->request->variable('ext_ignore', ['']);

			$order_list = array_filter($order_list, function($value) {
				return preg_match('/^[0-9]{1,2}$/', $value);
			});

			$this->config_text_set('extmgrplus_order_and_ignore_list', 'order', count($order_list) ? $order_list : null);
			$this->config_text_set('extmgrplus_order_and_ignore_list', 'ignore', count($ignore_list) ? $ignore_list : null);

			trigger_error($this->language->lang('EXTMGRPLUS_MSG_ORDER_AND_IGNORE_SAVED') . adm_back_link($this->u_action), E_USER_NOTICE);
		}
	}

	public function ext_manager_after($event)
	{
		if ($event['action'] != 'list' || $this->extension_manager->is_disabled('lukewcs/extmgrplus'))
		{
			return;
		}

		$event['tpl_name'] = '@lukewcs_extmgrplus/acp_ext_mgr_plus_acp_ext_list';

		$this_meta = $this->extension_manager->create_extension_metadata_manager('lukewcs/extmgrplus')->get_metadata('all');
		$notes = [];

		$ext_list_enabled = $this->extension_manager->all_enabled();
		$ext_list_disabled = $this->extension_manager->all_disabled();
		$ext_list_migrations = $this->get_exts_with_new_migration($ext_list_disabled);

		$ext_list_versioncheck = [];
		if ($this->request->variable('versioncheck_force', false))
		{
			$this->versioncheck_save();
		}
		if ($this->config_text->get('extmgrplus_version_check') != '')
		{
			$ext_list_versioncheck = $this->versioncheck_list();
		}

		if ($this->config['extmgrplus_enable_order_and_ignore'])
		{
			$ext_list_ignore = $this->config_text_get('extmgrplus_order_and_ignore_list', 'ignore');
			$ext_list_order = $this->config_text_get('extmgrplus_order_and_ignore_list', 'order');
		}
		if (!isset($ext_list_order) || !is_array($ext_list_order))
		{
			$ext_list_order = [];
		}
		if (isset($ext_list_ignore) && is_array($ext_list_ignore))
		{
			$ext_list_ignore = array_flip($ext_list_ignore);
			$ext_list_enabled_and_ignored = array_intersect_key($ext_list_ignore, $ext_list_enabled);
			$ext_list_disabled_and_ignored = array_intersect_key($ext_list_ignore, $ext_list_disabled);
		}
		else
		{
			$ext_list_ignore = [];
			$ext_list_enabled_and_ignored = [];
			$ext_list_disabled_and_ignored = [];
		}

		if (!$this->config['extmgrplus_enable_self_disable'])
		{
			$ext_list_enabled_and_ignored['lukewcs/extmgrplus'] = '-';
		}
		if (!$this->config['extmgrplus_enable_migrations'])
		{
			$ext_list_disabled_and_ignored = array_merge($ext_list_disabled_and_ignored, $ext_list_migrations);
		}

		$ext_count_available		= count($this->extension_manager->all_available());
		$ext_count_configured		= count($this->extension_manager->all_configured());
		$ext_count_migrations		= count($ext_list_migrations);
		$ext_count_enabled			= count($ext_list_enabled);
		$ext_count_enabled_clean	= $ext_count_enabled - count($ext_list_enabled_and_ignored);
		$ext_count_disabled			= count($ext_list_disabled);
		$ext_count_disabled_clean	= $ext_count_disabled - count($ext_list_disabled_and_ignored);

		$ext_display_name	= $this_meta['extra']['display-name'];
		$ext_ver			= $this_meta['version'];
		$ext_lang_min_ver	= $this_meta['extra']['lang-min-ver'];

		$ext_lang_ver 		= $this->get_lang_ver('EXTMGRPLUS_LANG_EXT_VER');
		$lang_outdated_msg	= $this->check_lang_ver($ext_display_name, $ext_lang_ver, $ext_lang_min_ver, 'EXTMGRPLUS_MSG_LANGUAGEPACK_OUTDATED');
		if ($lang_outdated_msg)
		{
			$notes[] = $lang_outdated_msg;
		}

		$this->template->assign_vars([
			'EXTMGRPLUS_ALLOW_MIGRATIONS'				=> $this->config['extmgrplus_enable_migrations'],
			'EXTMGRPLUS_ORDER'							=> $ext_list_order,
			'EXTMGRPLUS_IGNORE'							=> $ext_list_ignore,
			'EXTMGRPLUS_COUNT_AVAILABLE'				=> $ext_count_available,
			'EXTMGRPLUS_COUNT_ENABLED'					=> $ext_count_enabled,
			'EXTMGRPLUS_COUNT_ENABLED_CLEAN'			=> $ext_count_enabled_clean,
			'EXTMGRPLUS_COUNT_DISABLED'					=> $ext_count_disabled,
			'EXTMGRPLUS_COUNT_DISABLED_CLEAN'			=> $ext_count_disabled_clean,
			'EXTMGRPLUS_COUNT_HAS_MIGRATION'			=> $ext_count_migrations,
			'EXTMGRPLUS_COUNT_NOT_INSTALLED'			=> $ext_count_available - $ext_count_configured,
			'EXTMGRPLUS_MIGRATION_EXTS'					=> $ext_list_migrations,
			'EXTMGRPLUS_EXT_NAME'						=> $ext_display_name,
			'EXTMGRPLUS_EXT_VER'						=> $ext_ver,
			'EXTMGRPLUS_NOTES'							=> $notes,
			'EXTMGRPLUS_EXT_VERSIONCHECK'				=> $ext_list_versioncheck,
			'CDB_EXT_VER'								=> vsprintf('%u.%u', explode('.', PHPBB_VERSION)),

			'EXTMGRPLUS_ENABLE_LOG'						=> $this->config['extmgrplus_enable_log'],
			'EXTMGRPLUS_ENABLE_CONFIRMATION'			=> $this->config['extmgrplus_enable_confirmation'],
			'EXTMGRPLUS_ENABLE_CHECKBOXES_ALL_SET'		=> $this->config['extmgrplus_enable_checkboxes_all_set'],
			'EXTMGRPLUS_ENABLE_ORDER_AND_IGNORE'		=> $this->config['extmgrplus_enable_order_and_ignore'],
			'EXTMGRPLUS_ENABLE_SELF_DISABLE'			=> $this->config['extmgrplus_enable_self_disable'],
			'EXTMGRPLUS_ENABLE_MIGRATIONS'				=> $this->config['extmgrplus_enable_migrations'],
		]);
	}

	public function catch_message()
	{
		$last_action = $this->template->retrieve_var('EXTMGRPLUS_LAST_EMP_ACTION');
		if ($this->extension_manager->is_disabled('lukewcs/extmgrplus') || $last_action == '')
		{
			return;
		}
		$ext_name = $this->template->retrieve_var('EXTMGRPLUS_LAST_EXT_NAME');
		$ext_display_name = $this->template->retrieve_var('EXTMGRPLUS_LAST_EXT_DISPLAY_NAME');
		$message_text = $this->template->retrieve_var('MESSAGE_TEXT');
		$s_user_notice = $this->template->retrieve_var('S_USER_NOTICE');
		$s_user_warning = $this->template->retrieve_var('S_USER_WARNING');

		if (
			$ext_name != ''
			&& $ext_display_name != ''
			&& $message_text != ''
			&& ($s_user_notice || $s_user_warning)
		)
		{
			$this->template->assign_vars([
				'MESSAGE_TEXT'		=>	sprintf('%1$s<br><br><strong>%2$s (%3$s)</strong><br><br><em>%4$s</em><br><br>%5$s',
											/* 1 */	$this->language->lang('EXTMGRPLUS_MSG_PROCESS_ABORTED', $this->language->lang($last_action)),
											/* 2 */	$ext_display_name,
											/* 3 */	$ext_name,
											/* 4 */	$message_text,
											/* 5 */	$this->extmgr_back_link()
										),
				'S_USER_NOTICE'		=>	false,
				'S_USER_WARNING'	=>	true,
			]);
		}
	}

	private function enable_disable_confirm()
	{
		if ($this->request->is_set_post('extmgrplus_disable_all'))
		{
			$ext_list_marked = $this->request->variable('ext_mark_enabled', ['']);
			$ext_count_enabled = count($ext_list_marked);

			if ($this->config['extmgrplus_enable_confirmation'])
			{
				if (confirm_box(true))
				{
					$this->enable_disable("disable");
				}
				else
				{
					confirm_box(
						false,
						$this->language->lang('EXTMGRPLUS_MSG_CONFIRM_DISABLE', $this->language->lang('EXTMGRPLUS_EXTENSION_PLURAL', $ext_count_enabled)) .
							(array_search('lukewcs/extmgrplus', $ext_list_marked) !== false ? '<br><br>' . $this->language->lang('EXTMGRPLUS_MSG_SELF_DISABLE') : ''),
						build_hidden_fields([
							'extmgrplus_disable_all'	=> true,
							'ext_mark_enabled'			=> $ext_list_marked,
							'u_action'					=> $this->u_action
						]),
						'@lukewcs_extmgrplus/acp_ext_mgr_plus_confirm_body.html'
					);
				}
			}
			else
			{
				$this->enable_disable("disable");
			}
		}
		else if ($this->request->is_set_post('extmgrplus_enable_all'))
		{
			$ext_list_marked = $this->request->variable('ext_mark_disabled', ['']);
			$ext_count_disabled = count($ext_list_marked);

			if ($this->config['extmgrplus_enable_confirmation'])
			{
				if (confirm_box(true))
				{
					$this->enable_disable("enable");
				}
				else
				{
					confirm_box(
						false,
						$this->language->lang('EXTMGRPLUS_MSG_CONFIRM_ENABLE', $this->language->lang('EXTMGRPLUS_EXTENSION_PLURAL', $ext_count_disabled)),
						build_hidden_fields([
							'extmgrplus_enable_all'		=> true,
							'ext_mark_disabled'			=> $ext_list_marked,
							'u_action'					=> $this->u_action
						]),
						'@lukewcs_extmgrplus/acp_ext_mgr_plus_confirm_body.html'
					);
				}
			}
			else
			{
				$this->enable_disable("enable");
			}
		}

		redirect($this->request->variable('u_action', ''));
	}

	private function enable_disable(string $action)
	{
		$safe_time_limit = round(ini_get('max_execution_time') / 2);
		$start_time = time();
		$safe_time_exceeded = false;

		if ($action == "disable")
		{
			$ext_list_marked = $this->request->variable('ext_mark_enabled', ['']);
			$ext_list_enabled = array_flip($ext_list_marked);
			$ext_count_enabled = count($ext_list_enabled);
			$ext_count_success = 0;

			if (phpbb_version_compare(PHPBB_VERSION, '3.3.8', '<'))
			{
				$this->config_text_set('extmgrplus_todo_list', 'purge_cache', true);
			}

			foreach ($ext_list_enabled as $ext_name => $value)
			{
				$ext_display_name = $this->extension_manager->create_extension_metadata_manager($ext_name)->get_metadata('display-name');
				$this->set_last_ext_template_vars('EXTMGRPLUS_ALL_DISABLE', $ext_name, $ext_display_name);

				if ($this->extension_manager->is_enabled($ext_name))
				{
					if ($ext_name != 'lukewcs/extmgrplus')
					{
						while ($this->extension_manager->disable_step($ext_name))
						{
						}
					}
					else if ($this->config['extmgrplus_enable_self_disable'])
					{
						$this->config_text_set('extmgrplus_todo_list', 'self_disable', true);
						$ext_count_success++;
					}
				}

				if ($this->extension_manager->is_disabled($ext_name))
				{
					$ext_count_success++;
				}

				if ($this->config['extmgrplus_enable_log'])
				{
					$this->config_text_set('extmgrplus_todo_list', 'add_log', $this->get_log_data(
						'EXTMGRPLUS_LOG_EXT_DISABLE_ALL',
						$ext_count_success,
						$ext_count_enabled
					));
				}

				if ((time() - $start_time) >= $safe_time_limit)
				{
					$safe_time_exceeded = true;
					break;
				}
			}

			$this->set_last_ext_template_vars('', '', '');

			if ($safe_time_exceeded)
			{
				trigger_error(sprintf('%1$s<br><br><strong>%2$s</strong><br><br>%3$s',
						/* 1 */	$this->language->lang('EXTMGRPLUS_MSG_DEACTIVATION', $ext_count_success, $ext_count_enabled),
						/* 2 */	$this->language->lang('EXTMGRPLUS_MSG_SAFE_TIME_EXCEEDED', $safe_time_limit, ini_get('max_execution_time')),
						/* 3 */	$this->extmgr_back_link()
					)
					, E_USER_WARNING
				);
			}
			else
			{
				trigger_error(sprintf('%1$s<br><br>%2$s',
						/* 1 */	$this->language->lang('EXTMGRPLUS_MSG_DEACTIVATION', $ext_count_success, $ext_count_enabled),
						/* 2 */	$this->extmgr_back_link()
					)
					, (($ext_count_success != $ext_count_enabled) ? E_USER_WARNING : E_USER_NOTICE)
				);
			}
		}
		else if ($action == "enable")
		{
			$ext_list_marked = $this->request->variable('ext_mark_disabled', ['']);
			$ext_list_disabled = array_flip($ext_list_marked);

			$ext_list_failed_activation = [];
			$msg_failed = '';
			$get_failed_msg = function ($display_name, $ext_name, $message)
			{
				return sprintf('<br><br><strong>%1$s (%2$s)</strong><br><br><em>%3$s</em>',
					/* 1 */	$display_name,
					/* 2 */	$ext_name,
					/* 3 */	$message
				);
			};

			if ($this->config['extmgrplus_enable_order_and_ignore'])
			{
				$ext_list_order = $this->config_text_get('extmgrplus_order_and_ignore_list', 'order');
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

			$ext_count_disabled = count($ext_list_disabled);
			$ext_count_success = 0;

			if (phpbb_version_compare(PHPBB_VERSION, '3.3.8', '<'))
			{
				$this->config_text_set('extmgrplus_todo_list', 'purge_cache', true);
			}

			foreach ($ext_list_disabled as $ext_name => $value)
			{
				$ext_display_name = $this->extension_manager->create_extension_metadata_manager($ext_name)->get_metadata('display-name');
				$this->set_last_ext_template_vars('EXTMGRPLUS_ALL_ENABLE', $ext_name, $ext_display_name);

				$is_enableable = $this->extension_manager->get_extension($ext_name)->is_enableable();
				if ($this->extension_manager->is_disabled($ext_name) && $is_enableable === true)
				{
					try
					{
						while ($this->extension_manager->enable_step($ext_name))
						{
						}
					}
					catch (\phpbb\db\migration\exception $e)
					{
						$msg_failed = $get_failed_msg($ext_display_name, $ext_name, $e->getLocalisedMessage($this->user));
						trigger_error($this->language->lang('EXTMGRPLUS_MSG_PROCESS_ABORTED', $this->language->lang('EXTMGRPLUS_ALL_ENABLE')) . $msg_failed . '<br><br>' . $this->extmgr_back_link()
							, E_USER_WARNING
						);
					}
				}

				if ($this->extension_manager->is_enabled($ext_name))
				{
					$ext_count_success++;
				}
				else
				{
					$ext_list_failed_activation[$ext_name] = [
						'display_name'	=> $ext_display_name,
						'message'		=> (empty($is_enableable) ? $this->language->lang('EXTENSION_NOT_ENABLEABLE') : $is_enableable),
					];
				}

				if ($this->config['extmgrplus_enable_log'])
				{
					$this->config_text_set('extmgrplus_todo_list', 'add_log', $this->get_log_data(
						'EXTMGRPLUS_LOG_EXT_ENABLE_ALL',
						$ext_count_success,
						$ext_count_disabled
					));
				}

				if ((time() - $start_time) >= $safe_time_limit)
				{
					$safe_time_exceeded = true;
					break;
				}
			}

			if (count($ext_list_failed_activation))
			{
				$msg_failed = '<br><br>' . $this->language->lang('EXTMGRPLUS_MSG_ACTIVATION_FAILED');
				foreach ($ext_list_failed_activation as $name => $vars)
				{
					if (is_array($vars['message']))
					{
						$vars['message'] = implode('<br>', $vars['message']);
					}
					$msg_failed .= $get_failed_msg($vars['display_name'], $name, $vars['message']);
				}
			}

			$this->set_last_ext_template_vars('', '', '');

			if ($safe_time_exceeded)
			{
				trigger_error(sprintf('%1$s<br><br><strong>%2$s</strong><br><br>%3$s',
						/* 1 */	$this->language->lang('EXTMGRPLUS_MSG_ACTIVATION', $ext_count_success, $ext_count_disabled),
						/* 2 */	$this->language->lang('EXTMGRPLUS_MSG_SAFE_TIME_EXCEEDED', $safe_time_limit, ini_get('max_execution_time')),
						/* 3 */	$this->extmgr_back_link()
					)
					, E_USER_WARNING
				);
			}
			else
			{
				trigger_error(sprintf('%1$s%2$s<br><br>%3$s',
						/* 1 */	$this->language->lang('EXTMGRPLUS_MSG_ACTIVATION', $ext_count_success, $ext_count_disabled),
						/* 2 */ $msg_failed,
						/* 3 */	$this->extmgr_back_link()
					)
					, (($ext_count_success != $ext_count_disabled) ? E_USER_WARNING : E_USER_NOTICE)
				);
			}
		}
	}

	// Store information about the current process in template variables
	private function set_last_ext_template_vars(string $action, string $ext_name, string $ext_display_name)
	{
		$this->template->assign_vars([
			'EXTMGRPLUS_LAST_EMP_ACTION'		=> $action,
			'EXTMGRPLUS_LAST_EXT_NAME'			=> $ext_name,
			'EXTMGRPLUS_LAST_EXT_DISPLAY_NAME'	=> $ext_display_name,
		]);
	}

	// Determine all extensions that have new migrations from the passed list of extensions
	private function get_exts_with_new_migration(array $ext_list): array
	{
		$ext_with_migrations_list = [];

		foreach ($ext_list as $ext_name => $ext_value)
		{
			$ext_path = $this->extension_manager->get_extension_path($ext_name, true);
			$migration_files_count = $this->get_migration_files_count($ext_name, $ext_path);
			if ($migration_files_count)
			{
				$ext_with_migrations_list[$ext_name] = $migration_files_count;
			}
		}

		return $ext_with_migrations_list;
	}

	// Get the number of new migration files of the specified extension
	private function get_migration_files_count(string $ext_name, string $ext_path): int
	{
		$migrations = $this->extension_manager->get_finder()->extension_directory('/migrations')->find_from_extension($ext_name, $ext_path, false);
		$migrations_classes = $this->extension_manager->get_finder()->get_classes_from_files($migrations);

		$this->migrator = $this->phpbb_container->get('migrator');
		$this->migrator->set_migrations($migrations_classes);
		$migrations = $this->migrator->get_installable_migrations();
		$this->migrator->set_migrations([]);

		return count($migrations);
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

	// Determine the version of the language pack with fallback to 0.0.0
	private function get_lang_ver(string $lang_ext_ver): string
	{
		return ($this->language->is_set($lang_ext_ver) ? preg_replace('/[^0-9.]/', '', $this->language->lang($lang_ext_ver)) : '0.0.0');
	}

	// Check the language pack version for the minimum version and generate notice if outdated
	private function check_lang_ver(string $ext_name, string $ext_lang_ver, string $ext_lang_min_ver, string $lang_outdated_var): string
	{
		$lang_outdated_msg = '';

		if (phpbb_version_compare($ext_lang_ver, $ext_lang_min_ver, '<'))
		{
			if ($this->language->is_set($lang_outdated_var))
			{
				$lang_outdated_msg = $this->language->lang($lang_outdated_var);
			}
			else // Fallback if the current language package does not yet have the required variable.
			{
				$lang_outdated_msg = 'Note: The language pack for the extension <strong>%1$s</strong> is no longer up-to-date. (installed: %2$s / needed: %3$s)';
			}
			$lang_outdated_msg = sprintf($lang_outdated_msg, $ext_name, $ext_lang_ver, $ext_lang_min_ver);
		}

		return $lang_outdated_msg;
	}

	// Set a variable/array in a config_text variable container or delete one or all variables/arrays
	private function config_text_set($container, $name, $value)
	{
		if ($this->config_text->get($container) === null)
		{
			$vars = null;
		}
		else
		{
			$vars = json_decode($this->config_text->get($container), true);
		}
		if ($name !== null && $value !== null)
		{
			if ($vars === null)
			{
				$vars = [];
			}
			$vars[$name] = $value;
			$this->config_text->set($container, json_encode($vars));
		}
		else if ($name !== null && $value === null)
		{
			unset($vars[$name]);
			$this->config_text->set($container, (is_array($vars) && count($vars) ? json_encode($vars) : ''));
		}
		else if ($name === null && $value === null)
		{
			$this->config_text->set($container, '');
		}
	}

	// Get a variable from a config_text variable container
	private function config_text_get($container, $name)
	{
		if ($this->config_text->get($container) === null)
		{
			return null;
		}
		$vars = json_decode($this->config_text->get($container), true);
		return (($vars !== null && isset($vars[$name])) ? $vars[$name] : null);
	}

	// Generates a back link to the extension manager page
	private function extmgr_back_link(): string
	{
		return sprintf('<a href="%1$s">%2$s</a>',
			/* 1 */ $this->u_action . '&amp;action=list',
			/* 2 */ $this->language->lang('RETURN_TO_EXTENSION_LIST')
		);
	}

	// Writes the cached version check data to the database.
	private function versioncheck_save()
	{
		$ext_list_db = [
			'data' => [
				'date' => time(),
			],
		];
		foreach ($this->extension_manager->all_available() as $ext_name => $path)
		{
			$md_manager = $this->extension_manager->create_extension_metadata_manager($ext_name);

			try
			{
				$meta = $md_manager->get_metadata('all');

				if (isset($meta['extra']['version-check']))
				{
					$update_data = $this->extension_manager->version_check($md_manager, false, true);
					if (!empty($update_data))
					{
						$ext_list_db[$ext_name] = [
							'current' => $update_data['current'],
						];
					}
				}
			}
			catch (exception_interface $e)
			{
			}
			catch (\RuntimeException $e)
			{
			}
		}
		$this->config_text_set('extmgrplus_version_check', 'updates', $ext_list_db);
	}

	// Reads the version check data from the database and removes obsolete entries and generates a list for the template
	private function versioncheck_list(): array
	{
		$ext_list_db = $this->config_text_get('extmgrplus_version_check', 'updates');
		$ext_list_tpl = [
			'data' => [
				'LOCAL_DATE' => $this->user->format_date($ext_list_db['data']['date']),
			],
		];

		$ext_list_db_count = count($ext_list_db);
		foreach ($ext_list_db as $ext_name => $ext_data)
		{
			if ($ext_name == 'data')
			{
				continue;
			}
			if ($this->extension_manager->is_available($ext_name))
			{
				$meta = $this->extension_manager->create_extension_metadata_manager($ext_name)->get_metadata('all');

				if (phpbb_version_compare($meta['version'], $ext_data['current'], '<'))
				{
					$ext_list_tpl[$ext_name]  = [
						'CURRENT' => $ext_data['current'],
					];
				}
			}
			if (!isset($ext_list_tpl[$ext_name]))
			{
				unset($ext_list_db[$ext_name]);
			}
		}
		if (count($ext_list_db) < $ext_list_db_count)
		{
			$this->config_text_set('extmgrplus_version_check', 'updates', $ext_list_db);
		}

		return $ext_list_tpl;
	}
}
