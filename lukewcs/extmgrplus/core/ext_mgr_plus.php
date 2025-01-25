<?php
/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
* Note: This extension is 100% genuine handcraft and consists of selected
*       natural raw materials. There was no AI involved in making it.
*
*/

namespace lukewcs\extmgrplus\core;

class ext_mgr_plus
{
	protected const  CHECKBOX_OFF	= 0;
	protected const  CHECKBOX_ALL	= 1;
	protected const  CHECKBOX_LAST	= 2;

	protected object $common;
	protected object $ext_manager;
	protected object $cache;
	protected object $request;
	protected object $log;
	protected object $user;
	protected object $config;
	protected object $config_text;
	protected object $language;
	protected object $template;
	protected object $db;
	protected string $table_prefix;
	protected string $phpbb_root_path;
	protected string $php_ext;

	protected string $u_action;
	protected int    $safe_time_limit;
	protected string $phpbb_admin_path;

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
		\phpbb\path_helper $path_helper,
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

		$this->phpbb_admin_path	= $this->phpbb_root_path . $path_helper->get_adm_relative_path();
	}

	/*
		EVENT: core.acp_extensions_run_action_before
	*/
	public function ext_manager_before($event): void
	{
		if ($event['action'] != 'list' && $event['action'] != 'details' && $event['action'] != 'none')
		{
			return;
		}

		$this->u_action = $event['u_action'];
		$this->common->u_action = $this->u_action;
		$this->safe_time_limit = $event['safe_time_limit'];

		$this->language->add_lang(['acp_ext_mgr_plus', 'acp_ext_mgr_plus_lang_author'], 'lukewcs/extmgrplus');
		$this->common->set_meta_template_vars('EXTMGRPLUS', 'LukeWCS');

		add_form_key('lukewcs_extmgrplus');

		if ($this->request->is_set_post('extmgrplus_enable_all') || $this->request->is_set_post('extmgrplus_disable_all'))
		{
			$this->common->check_form_key_('lukewcs_extmgrplus');

			$this->exts_switch_confirm();
		}
		else if ($this->request->is_set_post('extmgrplus_save_ext_properties'))
		{
			$this->common->check_form_key_('lukewcs_extmgrplus');

			if ($this->config['extmgrplus_switch_order_and_ignore'])
			{
				$order_list = $this->request->variable('ext_order', ['' => '']);
				$ignore_list = $this->request->variable('ext_ignore', ['']);
				$order_list = preg_grep('/^\+?[0-9]{1,2}$/', $order_list);

				$this->common->config_text_set('extmgrplus_list_order_and_ignore', 'order', count($order_list) ? $order_list : null);
				$this->common->config_text_set('extmgrplus_list_order_and_ignore', 'ignore', count($ignore_list) ? $ignore_list : null);
			}

			$this->common->trigger_error_($this->language->lang('EXTMGRPLUS_MSG_EXT_PROPERTIES_SAVED'), E_USER_NOTICE, 'RETURN_TO_EXTENSION_LIST');
		}
		else if ($this->request->is_set_post('extmgrplus_save_checkboxes') && $this->config['extmgrplus_select_checkbox_mode'] == self::CHECKBOX_LAST)
		{
			$this->common->check_form_key_('lukewcs_extmgrplus');

			$ext_mark_enabled	= $this->request->variable('ext_mark_enabled', ['']);
			$ext_mark_disabled	= $this->request->variable('ext_mark_disabled', ['']);
			$ext_mark_list		= array_merge($ext_mark_enabled, $ext_mark_disabled);

			$this->common->config_text_set('extmgrplus_list_selected', 'selected', count($ext_mark_list) ? $ext_mark_list : null);

			$this->common->trigger_error_($this->language->lang('EXTMGRPLUS_MSG_CHECKBOXES_SAVED'), E_USER_NOTICE, 'RETURN_TO_EXTENSION_LIST');
		}
	}

	/*
		EVENT: core.acp_extensions_run_action_after
	*/
	public function ext_manager_after($event): void
	{
		if ($event['action'] == 'details')
		{
			$this->extend_details($event['ext_name']);
			$this->versioncheck_details($event['ext_name']);
			return;
		}
		else if ($event['action'] != 'list' && $event['action'] != 'none')
		{
			return;
		}

		$ext_list_versioncheck	= $this->common->config_text_get('extmgrplus_list_version_check', 'updates');
		$vc_request				= $this->request->is_set('versioncheck');
		$vc_active				= $ext_list_versioncheck['data']['vc_active'] ?? false;
		if ($vc_request && !$vc_active)
		{
			$this->versioncheck_prepare($ext_list_versioncheck);
		}
		else if ($vc_request && $vc_active && !$this->versioncheck_global($ext_list_versioncheck))
		{
			redirect($this->u_action);
		}
		if ($vc_request)
		{
			$event['tpl_name'] = '@lukewcs_extmgrplus/acp_ext_mgr_plus_versioncheck';
			$this->template->assign_vars([
				'EXTMGRPLUS_VC_DATA'		=> $ext_list_versioncheck['data'],
				'U_EXTMGRPLUS_VC_CANCEL'	=> $this->u_action,
			]);
			meta_refresh(1, $this->u_action . '&amp;action=none&amp;versioncheck');
			return;
		}
		else if ($vc_active)
		{
			$ext_list_versioncheck['data']['vc_active'] = false;
			$this->common->config_text_set('extmgrplus_list_version_check', 'updates', $ext_list_versioncheck);
		}

		$event['tpl_name'] = '@lukewcs_extmgrplus/acp_ext_mgr_plus_acp_ext_list';

		$ext_list_available				= $this->ext_manager->all_available();
		$ext_list_enabled				= $this->ext_manager->all_enabled();
		$ext_list_disabled				= $this->ext_manager->all_disabled();
		$ext_list_not_installed			= array_diff_key($ext_list_available, $this->ext_manager->all_configured());
		$ext_list_enabled_invalid		= array_diff_key($ext_list_enabled, $ext_list_available);
		$ext_list_disabled_invalid		= array_diff_key($ext_list_disabled, $ext_list_available);
		$ext_list_enabled_effective		= array_diff_key($ext_list_enabled, $ext_list_enabled_invalid);
		$ext_list_disabled_effective	= array_merge($ext_list_disabled, $ext_list_enabled_invalid);

		$notes									= [];
		$ext_list_migrations_inactive			= [];
		$ext_list_order							= [];
		$ext_list_ignore						= [];
		$ext_list_modules						= [];
		$ext_list_enabled_ignored				= [];
		$ext_list_disabled_ignored				= [];
		$ext_list_selected						= [];
		$ext_list_enabled_selected_effective	= [];
		$ext_list_disabled_selected_effective	= [];

		if ($this->config['extmgrplus_switch_order_and_ignore'])
		{
			$config_text		= $this->common->config_text_get('extmgrplus_list_order_and_ignore');
			$ext_list_order		= $config_text['order'] ?? [];
			$ext_list_ignore	= array_flip($config_text['ignore'] ?? []);
		}
		if (count($ext_list_ignore))
		{
			$ext_list_enabled_ignored	= array_intersect_key($ext_list_ignore, $ext_list_enabled);
			$ext_list_disabled_ignored	= array_intersect_key($ext_list_ignore, $ext_list_disabled);
		}

		if ($this->config['extmgrplus_switch_settings_link'])
		{
			$ext_list_modules = $this->get_module_links();
		}

		if ($this->config['extmgrplus_switch_migration_col'])
		{
			$ext_list_migrations_inactive = $this->get_exts_with_new_migration(array_diff_key($ext_list_available, $ext_list_enabled, $ext_list_ignore));
			$ext_list_migrations_disabled = array_intersect_key($ext_list_migrations_inactive, $ext_list_disabled);
		}
		else if (!$this->config['extmgrplus_switch_migrations'])
		{
			$ext_list_migrations_inactive = $this->get_exts_with_new_migration(array_diff_key($ext_list_disabled, $ext_list_ignore, $ext_list_disabled_invalid));
			$ext_list_migrations_disabled = $ext_list_migrations_inactive;
		}

		if (!$this->config['extmgrplus_switch_self_disable'])
		{
			$ext_list_enabled_ignored['lukewcs/extmgrplus'] = 0;
		}

		if (!$this->config['extmgrplus_switch_migrations'])
		{
			$ext_list_disabled_ignored = array_merge($ext_list_disabled_ignored, $ext_list_migrations_disabled);
		}

		$ext_list_enabled_selectable	= array_diff_key($ext_list_enabled, $ext_list_enabled_ignored, $ext_list_enabled_invalid);
		$ext_list_disabled_selectable	= array_diff_key($ext_list_disabled, $ext_list_disabled_ignored, $ext_list_disabled_invalid);

		if ($this->config['extmgrplus_select_checkbox_mode'] == self::CHECKBOX_ALL)
		{
			$ext_list_selected = array_merge($ext_list_enabled_selectable, $ext_list_disabled_selectable);
		}
		else if ($this->config['extmgrplus_select_checkbox_mode'] == self::CHECKBOX_LAST)
		{
			$ext_list_selected = array_flip($this->common->config_text_get('extmgrplus_list_selected', 'selected') ?? []);
		}
		if (count($ext_list_selected))
		{
			$ext_list_enabled_selected				= array_intersect_key($ext_list_selected, $ext_list_enabled);
			$ext_list_disabled_selected				= array_intersect_key($ext_list_selected, $ext_list_disabled);
			$ext_list_enabled_selected_effective	= array_diff_key($ext_list_enabled_selected, $ext_list_enabled_ignored, $ext_list_enabled_invalid);
			$ext_list_disabled_selected_effective	= array_diff_key($ext_list_disabled_selected, $ext_list_disabled_ignored, $ext_list_disabled_invalid);
		}

		$lang_outdated_msg = $this->common->lang_ver_check_msg('EXTMGRPLUS_LANG_VER', 'EXTMGRPLUS_MSG_LANGUAGEPACK_OUTDATED');
		if ($lang_outdated_msg)
		{
			$notes[] = $lang_outdated_msg;
		}

		$this->template->assign_vars([
			'EXTMGRPLUS_CDB_VER'					=> vsprintf('%u.%u', explode('.', PHPBB_VERSION)),
			'EXTMGRPLUS_NOTES'						=> $notes,
			'IS_PHPBB_MIN_3_3_14'					=> phpbb_version_compare(PHPBB_VERSION, '3.3.14', '>='),
			'U_EXTMGRPLUS_VERSIONCHECK'				=> $this->u_action . '&amp;action=none&amp;versioncheck',
			'EXTMGRPLUS_EXT_PROPERTIES'				=> $this->config['extmgrplus_switch_order_and_ignore'],

			'EXTMGRPLUS_LIST_ORDER'					=> $ext_list_order,
			'EXTMGRPLUS_LIST_IGNORE'				=> $ext_list_ignore,
			'EXTMGRPLUS_LIST_MIGRATIONS'			=> $ext_list_migrations_inactive,
			'EXTMGRPLUS_LIST_SELECTED'				=> $ext_list_selected,
			'EXTMGRPLUS_LIST_MODULES'				=> $ext_list_modules,
			'EXTMGRPLUS_LIST_VERSIONCHECK'			=> $this->versioncheck_list($ext_list_available, $ext_list_versioncheck),

			'EXTMGRPLUS_COUNT'						=> [
				'available'							=> count($ext_list_available),
				'invalid'							=> count($ext_list_enabled_invalid) + count($ext_list_disabled_invalid),
				'enabled'							=> count($ext_list_enabled_effective),
				'disabled'							=> count($ext_list_disabled_effective),
				'not_installed'						=> count($ext_list_not_installed),
				'enabled_selectable'				=> count($ext_list_enabled_selectable),
				'disabled_selectable'				=> count($ext_list_disabled_selectable),
				'enabled_selected'					=> count($ext_list_enabled_selected_effective),
				'disabled_selected'					=> count($ext_list_disabled_selected_effective),
			],

			'EXTMGRPLUS_SELECT_CHECKBOX_MODE'		=> $this->config['extmgrplus_select_checkbox_mode'],
			'EXTMGRPLUS_SWITCH_ORDER_AND_IGNORE'	=> $this->config['extmgrplus_switch_order_and_ignore'],
			'EXTMGRPLUS_SWITCH_SELF_DISABLE'		=> $this->config['extmgrplus_switch_self_disable'],
			'EXTMGRPLUS_SWITCH_INSTRUCTIONS'		=> $this->config['extmgrplus_switch_instructions'],
			'EXTMGRPLUS_SWITCH_SETTINGS_LINK'		=> $this->config['extmgrplus_switch_settings_link'],
			'EXTMGRPLUS_SWITCH_MIGRATION_COL'		=> $this->config['extmgrplus_switch_migration_col'],
			'EXTMGRPLUS_SWITCH_MIGRATIONS'			=> $this->config['extmgrplus_switch_migrations'],
		]);
	}

	/*
		Change template for trigger_error messages
		EVENT: core.adm_page_footer
	*/
	public function change_msg_template(): void
	{
		if ($this->template->retrieve_var('EXTMGRPLUS_TRIGGER_ERROR'))
		{
			$this->template->set_filenames(['body' => '@lukewcs_extmgrplus/acp_ext_mgr_plus_message_body.html']);
		}
	}

	/*
		Is required to suppress the normal function of trigger_error within ext.php and to be able to process its message
	*/
	public function error_handler(int $errno, string $msg_text, string $errfile, int $errline): void
	{
		if ($errno == E_USER_WARNING || $errno == E_USER_NOTICE)
		{
			throw new \phpbb\extension\exception('EXTMGRPLUS_SUPPRESS_TRIGGER_ERROR', [
				'errno'		=> $errno,
				'msg_text'	=> $msg_text,
				'errfile'	=> $errfile,
				'errline'	=> $errline,
			]);
		}
		msg_handler($errno, $msg_text, $errfile, $errline);
	}

	/*
		Primary control for deactivation/reactivation with optional dialog
	*/
	private function exts_switch_confirm(): void
	{
		$ext_mark_enabled	= $this->request->variable('ext_mark_enabled', ['']);
		$ext_mark_disabled	= $this->request->variable('ext_mark_disabled', ['']);

		$confirm_box = function (string $mode, int $ext_count) use ($ext_mark_enabled, $ext_mark_disabled): void
		{
			confirm_box(
				false,
				$this->language->lang('EXTMGRPLUS_MSG_CONFIRM_' . strtoupper($mode), $this->language->lang('EXTMGRPLUS_EXTENSION_PLURAL', $ext_count)),
				build_hidden_fields([
					"extmgrplus_{$mode}_all"	=> '1',
					'ext_mark_enabled'			=> $ext_mark_enabled,
					'ext_mark_disabled'			=> $ext_mark_disabled,
					'u_action'					=> $this->u_action
				]),
				'@lukewcs_extmgrplus/acp_ext_mgr_plus_confirm_body.html'
			);
		};

		if ($this->request->is_set_post('extmgrplus_disable_all'))
		{
			$this->template->assign_vars([
				'EXTMGRPLUS_ACTION_MODE'	=> 'DISABLE',
				'EXTMGRPLUS_CONFIRM_YES'	=> 'EXTENSION_DISABLE',
				'EXTMGRPLUS_CONFIRM_NO'		=> 'CANCEL',
			]);
			if (!$this->config['extmgrplus_switch_confirmation'] || confirm_box(true))
			{
				$this->exts_disable();
			}
			else
			{
				$confirm_box('disable', count($ext_mark_enabled));
			}
		}
		else if ($this->request->is_set_post('extmgrplus_enable_all'))
		{
			$this->template->assign_vars([
				'EXTMGRPLUS_ACTION_MODE'	=> 'ENABLE',
				'EXTMGRPLUS_CONFIRM_YES'	=> 'EXTENSION_ENABLE',
				'EXTMGRPLUS_CONFIRM_NO'		=> 'CANCEL',
			]);
			if (!$this->config['extmgrplus_switch_confirmation'] || confirm_box(true))
			{
				$this->exts_enable();
			}
			else
			{
				$confirm_box('enable', count($ext_mark_disabled));
			}
		}
		redirect($this->u_action);
	}

	/*
		Deactivate selected extensions
	*/
	private function exts_disable(): void
	{
		$ext_mark_enabled	= $this->request->variable('ext_mark_enabled', ['']);
		$ext_list_enabled	= array_flip($ext_mark_enabled);
		$ext_count_enabled	= count($ext_list_enabled);
		$ext_count_success	= 0;
		$safe_time_exceeded = false;

		if ($this->config['extmgrplus_select_checkbox_mode'] == self::CHECKBOX_LAST)
		{
			$ext_mark_disabled = $this->request->variable('ext_mark_disabled', ['']);
			$this->common->config_text_set('extmgrplus_list_selected', 'selected', array_merge($ext_mark_enabled, $ext_mark_disabled));
		}

		if ($this->config['extmgrplus_switch_order_and_ignore'])
		{
			$ext_list_order = $this->common->config_text_get('extmgrplus_list_order_and_ignore', 'order');
			if (is_array($ext_list_order))
			{
				$ext_list_order		= preg_grep('/^[0-9]{1,2}$/', $ext_list_order);
				$ext_list_order		= array_intersect_key($ext_list_order, $ext_list_enabled);
				$ext_list_enabled	= array_fill_keys($ext_mark_enabled, '999');
				$ext_list_enabled	= array_merge($ext_list_enabled, $ext_list_order);
				arsort($ext_list_enabled, SORT_NUMERIC);
			}
		}

		$ext_list_failed_deactivation = [];
		foreach ($ext_list_enabled as $ext_name => $ext_index)
		{
			try
			{
				$ext_metadata = $this->ext_manager->create_extension_metadata_manager($ext_name)->get_metadata('all');
			}
			catch (\RuntimeException $e)
			{
				$ext_metadata = null;
			}

			if (is_array($ext_metadata))
			{
				$ext_display_name	= $ext_metadata['extra']['display-name'] ?? '';
				$ext_version		= $ext_metadata['version'] ?? '';

				$disable_error = '';
				if ($this->ext_manager->is_enabled($ext_name))
				{
					set_error_handler([$this, 'error_handler']);
					try
					{
						while ($this->ext_manager->disable_step($ext_name))
						{
						}
					}
					catch (\phpbb\extension\exception $e)
					{
						$disable_error = $e->get_parameters()['msg_text'] ?? '';
					}
					restore_error_handler();
				}

				if ($this->ext_manager->is_disabled($ext_name))
				{
					$ext_count_success++;
				}
				else
				{
					$ext_list_failed_deactivation[$ext_name] = [
						'display_name'	=> $ext_display_name,
						'ext_version'	=> $ext_version,
						'message'		=> $disable_error,
					];
				}
			}

			if ($this->safe_time_limit > 0 && (microtime(true) - $GLOBALS['starttime']) >= $this->safe_time_limit)
			{
				$safe_time_exceeded = true;
				break;
			}
		}

		if ($this->config['extmgrplus_switch_log'])
		{
			$this->create_log_entry('EXTMGRPLUS_LOG_EXT_DISABLE_ALL', $ext_count_success, $ext_count_enabled);
		}

		if ($safe_time_exceeded)
		{
			$msg_failed = '<br><br><strong>' . $this->language->lang('EXTMGRPLUS_MSG_SAFE_TIME_EXCEEDED', $this->safe_time_limit) . '</strong>';
		}
		else if (count($ext_list_failed_deactivation))
		{
			$msg_failed = $this->create_failed_list_msg('EXTMGRPLUS_MSG_DEACTIVATION_FAILED', $ext_list_failed_deactivation);
		}
		$this->common->trigger_error_(
			$this->language->lang('EXTMGRPLUS_MSG_DEACTIVATION', $ext_count_success, $ext_count_enabled) . ($msg_failed ?? ''),
			(($ext_count_success != $ext_count_enabled || $safe_time_exceeded) ? E_USER_WARNING : E_USER_NOTICE),
			'RETURN_TO_EXTENSION_LIST'
		);
	}

	/*
		Reactivate selected extensions
	*/
	private function exts_enable(): void
	{
		$ext_mark_disabled	= $this->request->variable('ext_mark_disabled', ['']);
		$ext_list_disabled	= array_flip($ext_mark_disabled);
		$ext_count_disabled	= count($ext_list_disabled);
		$ext_count_success	= 0;
		$safe_time_exceeded = false;

		if ($this->config['extmgrplus_select_checkbox_mode'] == self::CHECKBOX_LAST)
		{
			$ext_mark_enabled = $this->request->variable('ext_mark_enabled', ['']);
			$this->common->config_text_set('extmgrplus_list_selected', 'selected', array_merge($ext_mark_enabled, $ext_mark_disabled));
		}

		if ($this->config['extmgrplus_switch_order_and_ignore'])
		{
			$ext_list_order = $this->common->config_text_get('extmgrplus_list_order_and_ignore', 'order');
			if (is_array($ext_list_order))
			{
				$ext_list_order		= preg_grep('/^[0-9]{1,2}$/', $ext_list_order);
				$ext_list_order		= array_intersect_key($ext_list_order, $ext_list_disabled);
				$ext_list_disabled	= array_fill_keys($ext_mark_disabled, '999');
				$ext_list_disabled	= array_merge($ext_list_disabled, $ext_list_order);
				asort($ext_list_disabled, SORT_NUMERIC);
			}
		}

		$ext_list_failed_activation = [];
		foreach ($ext_list_disabled as $ext_name => $ext_index)
		{
			try
			{
				$ext_metadata = $this->ext_manager->create_extension_metadata_manager($ext_name)->get_metadata('all');
			}
			catch (\RuntimeException $e)
			{
				$ext_metadata = null;
			}

			if (is_array($ext_metadata))
			{
				$ext_display_name	= $ext_metadata['extra']['display-name'] ?? '';
				$ext_version		= $ext_metadata['version'] ?? '';

				if ($this->ext_manager->is_disabled($ext_name))
				{
					set_error_handler([$this, 'error_handler']);
					try
					{
						$is_enableable = $this->ext_manager->get_extension($ext_name)->is_enableable();
						if ($is_enableable === true)
						{
							while ($this->ext_manager->enable_step($ext_name))
							{
							}
						}
					}
					catch (\phpbb\db\migration\exception $e)
					{
						restore_error_handler();
						$msg_failed = $this->create_failed_msg($ext_display_name, $ext_version, $ext_name, $e->getLocalisedMessage($this->user));
						$this->common->trigger_error_(
							$this->language->lang('EXTMGRPLUS_MSG_PROCESS_ABORTED', $this->language->lang('EXTMGRPLUS_ENABLE_ALL')) . $msg_failed,
							E_USER_WARNING,
							'RETURN_TO_EXTENSION_LIST'
						);
					}
					catch (\phpbb\extension\exception $e)
					{
						$is_enableable = $e->get_parameters()['msg_text'] ?? '';
					}
					restore_error_handler();
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
			}

			if ($this->safe_time_limit > 0 && (microtime(true) - $GLOBALS['starttime']) >= $this->safe_time_limit)
			{
				$safe_time_exceeded = true;
				break;
			}
		}

		if ($this->config['extmgrplus_switch_log'])
		{
			$this->create_log_entry('EXTMGRPLUS_LOG_EXT_ENABLE_ALL', $ext_count_success, $ext_count_disabled);
		}

		if ($safe_time_exceeded)
		{
			$msg_failed = '<br><br><strong>' . $this->language->lang('EXTMGRPLUS_MSG_SAFE_TIME_EXCEEDED', $this->safe_time_limit) . '</strong>';
		}
		else if (count($ext_list_failed_activation))
		{
			$msg_failed = $this->create_failed_list_msg('EXTMGRPLUS_MSG_ACTIVATION_FAILED', $ext_list_failed_activation);
		}
		$this->common->trigger_error_(
			$this->language->lang('EXTMGRPLUS_MSG_ACTIVATION', $ext_count_success, $ext_count_disabled) . ($msg_failed ?? ''),
			(($ext_count_success != $ext_count_disabled || $safe_time_exceeded) ? E_USER_WARNING : E_USER_NOTICE),
			'RETURN_TO_EXTENSION_LIST'
		);
	}

	/*
		Generate a message that lists all extensions that could not be switched with enable/disable
	*/
	private function create_failed_list_msg(string $lang_var, array &$ext_list): string
	{
		$msg_failed = '<br><br>' . $this->language->lang($lang_var);
		$count_failed = 0;
		foreach ($ext_list as $ext_name => $vars)
		{
			if (is_array($vars['message']))
			{
				$vars['message'] = implode('<br>', $vars['message']);
			}
			$count_failed++;
			$msg_failed .= $this->create_failed_msg($count_failed . '. ' . $vars['display_name'], $vars['ext_version'], $ext_name, $vars['message']);
		}

		return $msg_failed;
	}

	/*
		Helper function to generate a message text for an extension if enable/disable has failed
	*/
	private function create_failed_msg(string $display_name, string $ext_version, string $ext_name, string $message): string
	{
		return sprintf('<br><br><strong>%1$s %2$s (%3$s)</strong>%4$s',
			/* 1 */	$display_name,
			/* 2 */	$this->language->lang('EXTMGRPLUS_VERSION_STRING', $ext_version),
			/* 3 */	$ext_name,
			/* 4 */	empty($message) ? '' : "<br><br><em>{$message}</em>"
		);
	}

	/*
		Determine all extensions that have new migrations from the passed list of extensions
	*/
	private function get_exts_with_new_migration(array $ext_list): array
	{
		$sql = "SELECT migration_name
				FROM " . $this->table_prefix . 'migrations' . "
				WHERE migration_name LIKE '" . $this->db->sql_escape('%\\\\migrations\\\\%') . "'";
		$result = $this->db->sql_query($sql);
		$migrations_db = array_column($this->db->sql_fetchrowset($result) ?: [], 'migration_name');
		$this->db->sql_freeresult($result);

		$ext_with_migrations_list = [];
		foreach ($ext_list as $ext_name => $ext_path)
		{
			$migration_files_count = $this->get_new_migrations_count($ext_name, $ext_path, $migrations_db);
			if ($migration_files_count)
			{
				$ext_with_migrations_list[$ext_name] = $migration_files_count;
			}
		}

		return $ext_with_migrations_list;
	}

	/*
		Get the number of new migration files of the specified extension
	*/
	private function get_new_migrations_count(string $ext_name, string $ext_path, array &$migrations_db): int
	{
		$migrations_available	= $this->ext_manager->get_finder()->extension_directory('/migrations')->find_from_extension($ext_name, $ext_path, false);
		$migration_classes		= $this->ext_manager->get_finder()->get_classes_from_files($migrations_available);
		$migration_classes_db	= preg_grep('/' . str_replace('/', '\\\\', $ext_name) . '\\\\migrations\\\\/', $migrations_db);
		$migration_classes_new	= array_diff($migration_classes, $migration_classes_db);

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

	/*
		Determine all ACP module links of the active extensions
	*/
	private function get_module_links(): array
	{
		global $module;

		$module_urls = [];
		foreach (array_filter($module->module_ary, fn($row) => $row['name'] != '' && $row['display'] == 1) as $module_)
		{
			preg_match('/\\\\(.+?)\\\\(.+?)\\\\.*/', $module_['name'], $matches);
			$tech_name = (count($matches) == 3) ? $matches[1] . '/' . $matches[2] : false;
			if ($tech_name !== false && !isset($module_urls[$tech_name]))
			{
				$module_name = str_replace('\\', '-', $module_['name']);
				$module_urls[$tech_name] = append_sid("{$this->phpbb_admin_path}index.{$this->php_ext}", "i={$module_name}&amp;mode={$module_['mode']}");
			}
		}

		return $module_urls;
	}

	/*
		Check if file is a valid migration file
	*/
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
						&& preg_match('/^\s*?class\s+?' . $file_info['filename'] . '\s+/mi', $file_content)
					)
					? 1
					: 0
				);
			}
		}

		return ($check_migration ?? -1);
	}

	/*
		Create a log entry
	*/
	private function create_log_entry(string $log_lang_var, int $ext_count_success, int $ext_count_total): void
	{
		$this->log->add(
			'admin',
			$this->user->data['user_id'],
			$this->user->ip,
			$log_lang_var,
			time(),
			[
				$ext_count_success,
				$ext_count_total,
			]
		);
	}

	/*
		Preparation to be able to run a version check in blocks
	*/
	private function versioncheck_prepare(?array &$ext_list_vc): void
	{
		$ext_list_all	= $this->ext_manager->all_available();
		$ext_list_vc	= [
			'data' => [
				'date'			=> time(),
				'vc_active'		=> true,
				'vc_limit'		=> (int) $this->config['extmgrplus_number_vc_limit'],
				'duration'		=> 0,
				'count_done'	=> 0,
			],
		];

		foreach ($ext_list_all as $ext_name => $ext_path)
		{
			try
			{
				$vc_meta = $this->ext_manager->create_extension_metadata_manager($ext_name)->get_metadata('all')['extra']['version-check'] ?? null;
			}
			catch (\RuntimeException $e)
			{
			}

			if (isset($vc_meta))
			{
				$ext_list_vc[$ext_name]['current'] = '';

				$cache_filename = '_versioncheck_' . $vc_meta['host'] . $vc_meta['directory'] . $vc_meta['filename'] . ($vc_meta['ssl'] ?? false);
				$this->cache->destroy(str_replace(['/', '\\'], '-', $cache_filename));
			}
		}
		$ext_list_vc['data']['count_total']	= count($ext_list_vc) - 1;
		$this->common->config_text_set('extmgrplus_list_version_check', 'updates', $ext_list_vc);
	}

	/*
		Run global version check in blocks (for all extensions)
	*/
	private function versioncheck_global(array &$ext_list_vc): bool
	{
		$block_count = 0;
		foreach ($ext_list_vc as $ext_name => $vc_data)
		{
			if ($ext_name == 'data' || $vc_data['current'] != '')
			{
				continue;
			}

			$this->versioncheck($ext_list_vc, $ext_name);

			$block_count++;
			$block_time = microtime(true) - $GLOBALS['starttime'];
			if ($block_time > $this->config['extmgrplus_number_vc_limit'])
			{
				break;
			}
		}

		if ($block_count > 0 && ($this->common->config_text_get('extmgrplus_list_version_check', 'updates')['data']['vc_active'] ?? false))
		{
			$ext_list_vc['data']['count_done'] += $block_count;
			$ext_list_vc['data']['duration'] = round($ext_list_vc['data']['duration'] + $block_time, 3);
			$this->common->config_text_set('extmgrplus_list_version_check', 'updates', $ext_list_vc);
			return true;
		}

		return false;
	}

	/*
		Read local version check from cache (for a specific extension)
	*/
	private function versioncheck_details(string $ext_name): void
	{
		$ext_list_vc = $this->common->config_text_get('extmgrplus_list_version_check', 'updates') ?? [];

		if ($this->versioncheck($ext_list_vc, $ext_name, true))
		{
			$this->common->config_text_set('extmgrplus_list_version_check', 'updates', $ext_list_vc);
		}
	}

	/*
		Helper function for global and local version check
	*/
	private function versioncheck(array &$ext_list_vc, string $ext_name, bool $read_cache = false): bool
	{
		$md_manager			= $this->ext_manager->create_extension_metadata_manager($ext_name);
		$ext_list_vc_update	= false;

		try
		{
			$ext_metadata = $md_manager->get_metadata('all');
			if (isset($ext_metadata['extra']['version-check']))
			{
				$vc_data = $this->ext_manager->version_check($md_manager, !$read_cache, $read_cache, $this->config['extension_force_unstable'] ? 'unstable' : null);
				$vc_current = empty($vc_data) ? 'NOUPD' : $vc_data['current'];
			}
		}
		catch (exception_interface | \RuntimeException $e)
		{
			$vc_current = 'ERROR';
		}

		if (isset($vc_current) && $vc_current !== ($ext_list_vc[$ext_name]['current'] ?? null))
		{
			$ext_list_vc[$ext_name]['current'] = $vc_current;
			$ext_list_vc_update = true;
		}

		return $ext_list_vc_update;
	}

	/*
		Reads the version check data from the database and removes obsolete entries and generates a list for the template
	*/
	private function versioncheck_list(array &$ext_list, ?array &$ext_list_vc): array
	{
		$ext_list_vc ??= [];

		$ext_list_vc_update	= false;
		$ext_list_tpl		= [];
		$count_total		= 0;
		$count_errors		= 0;
		$count_updates		= 0;
		foreach ($ext_list_vc as $ext_name => &$vc_data)
		{
			if ($ext_name == 'data')
			{
				continue;
			}
			if ($this->ext_manager->is_available($ext_name))
			{
				$ext_metadata = $this->ext_manager->create_extension_metadata_manager($ext_name)->get_metadata('all');

				$no_ver_flags = $vc_data['current'] == 'NOUPD' || $vc_data['current'] == 'ERROR' || $vc_data['current'] == '';
				$has_update = !$no_ver_flags && phpbb_version_compare($ext_metadata['version'], $vc_data['current'], '<');
				if ($no_ver_flags || $has_update)
				{
					$ext_list_tpl[$ext_name]['current'] = $vc_data['current'];
					if ($vc_data['current'] == 'ERROR')
					{
						$count_errors++;
					}
					else if ($has_update)
					{
						$count_updates++;
					}
				}
				else
				{
					$ext_list_tpl[$ext_name]['current'] = 'NOUPD';
				}

				if ($ext_list_tpl[$ext_name]['current'] != $vc_data['current'])
				{
					$vc_data['current'] = $ext_list_tpl[$ext_name]['current'];
					$ext_list_vc_update = true;
				}
			}
			else
			{
				unset($ext_list_vc[$ext_name]);
				$ext_list_vc_update = true;
			}
		}
		unset($vc_data);

		if ($ext_list_vc_update)
		{
			$this->common->config_text_set('extmgrplus_list_version_check', 'updates', $ext_list_vc);
		}

		foreach ($ext_list as $ext_name => $ext_path)
		{
			try
			{
				$ext_metadata = $this->ext_manager->create_extension_metadata_manager($ext_name)->get_metadata('all');
			}
			catch (\RuntimeException $e)
			{
			}

			if (isset($ext_metadata['extra']['version-check']))
			{
				$ext_list_tpl[$ext_name]['cdb_ext']	= ($ext_metadata['extra']['version-check']['host'] ?? '') == 'www.phpbb.com';
				$count_total++;
			}
			else
			{
				$ext_list_tpl[$ext_name]['current'] = false;
			}
		}

		$ext_list_tpl['data'] = [
			'local_date'	=> (isset($ext_list_vc['data']['date']) ? $this->user->format_date($ext_list_vc['data']['date']) : null),
			'count_update'	=> $count_updates,
			'count_total'	=> $count_total,
			'count_error'	=> $count_errors,
			'duration'		=> $ext_list_vc['data']['duration'] ?? 0,
		];

		return $ext_list_tpl;
	}

	/*
		Expands the details page of an extension
	*/
	private function extend_details(string $ext_name): void
	{
		$vc_meta = $this->ext_manager->create_extension_metadata_manager($ext_name)->get_metadata('all')['extra']['version-check'] ?? null;
		$details = [];
		if (isset($vc_meta))
		{
			if (($vc_meta['host'] ?? '') == 'www.phpbb.com')
			{
				$details['cdb_page'] = 'https://www.phpbb.com' . $vc_meta['directory'] . '/';
			}
			if ($this->config['extmgrplus_switch_version_url'])
			{
				$details['version_url']	= (($vc_meta['ssl'] ?? false) ? 'https://' : 'http://') . $vc_meta['host'] . $vc_meta['directory'] . '/' . $vc_meta['filename'];
			}
		}
		$this->template->assign_var('EXTMGRPLUS_DETAILS', $details);
	}
}
