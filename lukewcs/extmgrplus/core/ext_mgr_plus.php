<?php
/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org/
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace lukewcs\extmgrplus\core;

class ext_mgr_plus
{
	protected $extension_manager;
	protected $request;
	protected $language;
	protected $config;
	protected $config_text;
	protected $template;
	protected $log;
	protected $user;
	protected $cache;
	protected $u_action;
	protected $migrator;

	public function __construct(
		\phpbb\extension\manager $ext_manager,
		\phpbb\request\request $request,
		\phpbb\language\language $language,
		\phpbb\config\config $config,
		\phpbb\config\db_text $config_text,
		\phpbb\template\template $template,
		\phpbb\log\log $log,
		\phpbb\user $user,
		\phpbb\cache\driver\driver_interface $cache,
		\phpbb\db\migrator $migrator
	)
	{
		$this->extension_manager	= $ext_manager;
		$this->request				= $request;
		$this->language				= $language;
		$this->config				= $config;
		$this->config_text			= $config_text;
		$this->template				= $template;
		$this->log					= $log;
		$this->user					= $user;
		$this->cache				= $cache;
		$this->migrator				= $migrator;
	}

	public function ext_manager($event)
	{
		$this->u_action = $event['u_action'];
		$this->language->add_lang('acp_ext_mgr_plus', 'lukewcs/extmgrplus');
		$this->md_manager = $this->extension_manager->create_extension_metadata_manager('lukewcs/extmgrplus');
		$notes = '';

		add_form_key('lukewcs_extmgrplus');

		if ($this->request->is_set_post('extmgrplus_enable_all') || $this->request->is_set_post('extmgrplus_disable_all'))
		{
			if (!check_form_key('lukewcs_extmgrplus'))
			{
				trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
			}
			$this->enable_disable_confirm();
			return;
		}
		else if ($this->request->is_set_post('submit') && $this->request->variable('extmgrplus_save_settings', '') == '1')
		{
			if (!check_form_key('lukewcs_extmgrplus'))
			{
				trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
			}
			$this->config->set('extmgrplus_enable_log', $this->request->variable('extmgrplus_enable_log', 0));
			$this->config->set('extmgrplus_enable_confirmation', $this->request->variable('extmgrplus_enable_confirmation', 0));
			$this->config->set('extmgrplus_enable_self_disable', $this->request->variable('extmgrplus_enable_self_disable', 0));
			$this->config->set('extmgrplus_enable_migrations', $this->request->variable('extmgrplus_enable_migrations', 0));
			trigger_error($this->language->lang('EXTMGRPLUS_MSG_SETTINGS_SAVED') . adm_back_link($this->u_action));
		}

		$ext_list_disabled = $this->extension_manager->all_disabled();
		$ext_list_migrations = $this->get_exts_with_new_migration($ext_list_disabled);

		$ext_count_available		= count($this->extension_manager->all_available());
		$ext_count_configured		= count($this->extension_manager->all_configured());
		$ext_count_migrations		= count($ext_list_migrations);
		$ext_count_enabled			= count($this->extension_manager->all_enabled());
		$ext_count_enabled_clean	= $ext_count_enabled - (!$this->config['extmgrplus_enable_self_disable'] ? 1 : 0);
		$ext_count_disabled			= count($ext_list_disabled);
		$ext_count_disabled_clean	= $ext_count_disabled - (!$this->config['extmgrplus_enable_migrations'] ? $ext_count_migrations : 0);

		$ext_display_name	= $this->md_manager->get_metadata('display-name');
		$ext_ver			= $this->md_manager->get_metadata('version');

		$ext_lang_min_ver	= $this->md_manager->get_metadata()['extra']['lang-min-ver'];
		$ext_lang_ver 		= $this->get_lang_ver('EXTMGRPLUS_LANG_EXT_VER');
		$lang_outdated_msg	= $this->check_lang_ver($ext_display_name, $ext_lang_ver, $ext_lang_min_ver, 'EXTMGRPLUS_MSG_LANGUAGEPACK_OUTDATED');
		$notes				= ($lang_outdated_msg) ? $this->add_note($notes, $lang_outdated_msg) : '';

		$this->template->assign_vars([
			'EXTMGRPLUS_ALLOW_MIGRATIONS'		=> $this->config['extmgrplus_enable_migrations'],
			'EXTMGRPLUS_COUNT_AVAILABLE'		=> $ext_count_available,
			'EXTMGRPLUS_COUNT_ENABLED'			=> $ext_count_enabled,
			'EXTMGRPLUS_COUNT_ENABLED_CLEAN'	=> $ext_count_enabled_clean,
			'EXTMGRPLUS_COUNT_DISABLED'			=> $ext_count_disabled,
			'EXTMGRPLUS_COUNT_DISABLED_CLEAN'	=> $ext_count_disabled_clean,
			'EXTMGRPLUS_COUNT_HAS_MIGRATION'	=> $ext_count_migrations,
			'EXTMGRPLUS_COUNT_NOT_INSTALLED'	=> $ext_count_available - $ext_count_configured,
			'EXTMGRPLUS_MIGRATION_EXTS'			=> $ext_list_migrations,
			'EXTMGRPLUS_EXT_NAME'				=> $ext_display_name,
			'EXTMGRPLUS_EXT_VER'				=> $ext_ver,
			'EXTMGRPLUS_NOTES'					=> $notes,
			'CDB_EXT_VER'						=> vsprintf('%u.%u', explode('.', PHPBB_VERSION)),

			'EXTMGRPLUS_ENABLE_LOG'				=> $this->config['extmgrplus_enable_log'],
			'EXTMGRPLUS_ENABLE_CONFIRMATION'	=> $this->config['extmgrplus_enable_confirmation'],
			'EXTMGRPLUS_ENABLE_SELF_DISABLE'	=> $this->config['extmgrplus_enable_self_disable'],
			'EXTMGRPLUS_ENABLE_MIGRATIONS'		=> $this->config['extmgrplus_enable_migrations'],
		]);
	}

	public function todo()
	{
		if ($this->todo_get('self_disable'))
		{
			$this->todo_set('self_disable', false);

			$safe_time_limit = (ini_get('max_execution_time') / 2);
			$start_time = time();

			$this->extension_manager->disable('lukewcs/extmgrplus');
			while ($this->extension_manager->disable_step('lukewcs/extmgrplus'))
			{
				if ((time() - $start_time) >= $safe_time_limit)
				{
					meta_refresh(0);
				}
			}
		}

		if ($this->todo_get('purge_cache'))
		{
			$this->todo_set('purge_cache', false);
			$this->cache->purge();
		}

		if ($this->todo_get('add_log'))
		{
			$last_job = $this->todo_get('add_log');
			$this->todo_set('add_log', []);

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
		$this->todo_set(null, null);
	}

	public function catch_errorbox()
	{
		$ext_name = $this->template->retrieve_var('EXTMGRPLUS_LAST_EXT_NAME');
		$ext_display_name = $this->template->retrieve_var('EXTMGRPLUS_LAST_EXT_DISPLAY_NAME');
		$message_text = $this->template->retrieve_var('MESSAGE_TEXT');
		$s_user_warning = $this->template->retrieve_var('S_USER_WARNING');

		if ($ext_name != '' && $ext_display_name != '' && $message_text != '' && $s_user_warning)
		{
			$this->template->assign_vars([
				'MESSAGE_TEXT' => sprintf('%s%s<br><br><strong>%s (%s)</strong><br><br>%s',
					$this->language->lang('EXTMGRPLUS_MSG_ACTIVATION_ABORTED'),
					$this->language->lang('COLON'),
					$ext_display_name,
					$ext_name,
					$message_text
				),
			]);
		}
	}

	private function enable_disable_confirm()
	{
		if ($this->request->is_set_post('extmgrplus_disable_all'))
		{
			$ext_marked = $this->request->variable('ext_enabled_mark', ['']);
			$ext_count_enabled = count($ext_marked);

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
						$this->language->lang('EXTMGRPLUS_MSG_CONFIRM_DISABLE', $this->language->lang('EXTMGRPLUS_EXTENSION_PLURAL', $ext_count_enabled)),
						build_hidden_fields([
							'extmgrplus_disable_all'	=> true,
							'extmgrplus_confirm_box'	=> true,
							'ext_enabled_mark'			=> $ext_marked,
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
			$ext_marked = $this->request->variable('ext_disabled_mark', ['']);
			$ext_count_disabled = count($ext_marked);

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
							'extmgrplus_confirm_box'	=> true,
							'ext_disabled_mark'			=> $ext_marked,
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

	private function enable_disable($action)
	{
		$safe_time_limit = (ini_get('max_execution_time') / 2);
		$start_time = time();

		if ($action == "disable")
		{
			$ext_marked = $this->request->variable('ext_enabled_mark', ['']);
			$ext_list_enabled = array_flip($ext_marked);
			$ext_count_enabled = count($ext_list_enabled);
			$ext_count_success = 0;

			$this->todo_set('purge_cache', true);

			foreach ($ext_list_enabled as $ext_name => $value)
			{
				if ($this->extension_manager->is_enabled($ext_name))
				{
					if ($ext_name != 'lukewcs/extmgrplus')
					{
						while ($this->extension_manager->disable_step($ext_name))
						{
							if ((time() - $start_time) >= $safe_time_limit)
							{
								meta_refresh(0);
							}
						}
					}
					else
					{
						$this->todo_set('self_disable', true);
						$ext_count_success++;
					}
				}

				if ($this->extension_manager->is_disabled($ext_name))
				{
					$ext_count_success++;
				}
			}

			if ($this->config['extmgrplus_enable_log'])
			{
				$this->todo_set('add_log', $this->get_log_data(
					'EXTMGRPLUS_LOG_EXT_DISABLE_ALL',
					$ext_count_success,
					$ext_count_enabled
				));
			}

			trigger_error($this->language->lang('EXTMGRPLUS_MSG_DEACTIVATION_SUCCESFULL', $ext_count_success, $ext_count_enabled) . adm_back_link($this->u_action), (($ext_count_success == 0) ? E_USER_WARNING : E_USER_NOTICE));
		}
		else if ($action == "enable")
		{
			$ext_marked = $this->request->variable('ext_disabled_mark', ['']);
			$ext_list_disabled = array_flip($ext_marked);
			$ext_count_disabled = count($ext_list_disabled);
			$ext_count_success = 0;

			$this->todo_set('purge_cache', true);

			foreach ($ext_list_disabled as $ext_name => $value)
			{
				$ext_display_name = $this->extension_manager->create_extension_metadata_manager($ext_name)->get_metadata('display-name');
				$this->set_last_ext_template_vars($ext_name, $ext_display_name);

				if ($this->extension_manager->is_disabled($ext_name))
				{
					while ($this->extension_manager->enable_step($ext_name))
					{
						if ((time() - $start_time) >= $safe_time_limit)
						{
							meta_refresh(0);
						}
					}
				}

				if ($this->extension_manager->is_enabled($ext_name))
				{
					$ext_count_success++;
				}

				if ($this->config['extmgrplus_enable_log'])
				{
					$this->todo_set('add_log', $this->get_log_data(
						'EXTMGRPLUS_LOG_EXT_ENABLE_ALL',
						$ext_count_success,
						$ext_count_disabled
					));
				}
			}

			$this->set_last_ext_template_vars('', '');

			trigger_error($this->language->lang('EXTMGRPLUS_MSG_ACTIVATION_SUCCESFULL', $ext_count_success, $ext_count_disabled) . adm_back_link($this->u_action), (($ext_count_success == 0) ? E_USER_WARNING : E_USER_NOTICE));
		}
	}

	private function set_last_ext_template_vars($ext_name, $ext_display_name)
	{
		$this->template->assign_vars([
			'EXTMGRPLUS_LAST_EXT_NAME'			=> $ext_name,
			'EXTMGRPLUS_LAST_EXT_DISPLAY_NAME'	=> $ext_display_name,
		]);
	}

	// Remove from the passed list of extensions all that have new migrations
	private function remove_exts_with_new_migrations(array $ext_list): array
	{
		if (!$this->config['extmgrplus_enable_migrations'])
		{
			foreach ($ext_list as $ext_name => $value)
			{
				$ext_path = $this->extension_manager->get_extension_path($ext_name, true);
				if ($this->get_migration_files_count($ext_name, $ext_path))
				{
					unset($ext_list[$ext_name]);
				}
			}
		}

		return $ext_list;
	}

	// Determine all extensions that have new migrations from the passed list of extensions
	private function get_exts_with_new_migration(array $ext_list): array
	{
		$ext_with_migrations_list = [];

		foreach ($ext_list as $ext_name => &$ext_value)
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

		$this->migrator->set_migrations($migrations_classes);
		$migrations = $this->migrator->get_installable_migrations();
		$this->migrator->set_migrations([]);

		return count($migrations);
	}

	// Generate a log data package and convert it to JSON
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
		return $this->language->is_set($lang_ext_ver) ? preg_replace('/[^0-9.]/', '', $this->language->lang($lang_ext_ver)) : '0.0.0';
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
				$lang_outdated_msg = 'Note: The language pack for this extension is no longer up-to-date. (Installed: %1$s / Needed: %2$s)';
			}
			$lang_outdated_msg = sprintf($lang_outdated_msg, $ext_name, $ext_lang_ver, $ext_lang_min_ver);
		}

		return $lang_outdated_msg;
	}

	// Add text to submitted messages
	private function add_note(string $messages, string $text): string
	{
		return $messages . (($messages != '') ? "\n" : '') . sprintf('<p>%s</p>', $text);
	}

	// Set a todo job in config_text or delete one or all jobs
	private function todo_set($name, $value)
	{
		$jobs = json_decode($this->config_text->get('extmgrplus_todo_list'), true);
		if ($name !== null && $value !== null)
		{
			if ($jobs === null)
			{
				$jobs = [];
			}
			$jobs[$name] = $value;
			$this->config_text->set('extmgrplus_todo_list', json_encode($jobs));
		}
		else if ($name !== null && $value === null)
		{
			unset($jobs[$name]);
			$this->config_text->set('extmgrplus_todo_list', json_encode($jobs));
		}
		else if ($name === null && $value === null)
		{
			$this->config_text->set('extmgrplus_todo_list', '');
		}
	}

	// Get a todo job from config_text
	private function todo_get($name)
	{
		$jobs = json_decode($this->config_text->get('extmgrplus_todo_list'), true);
		return ($jobs !== null) ? $jobs[$name] : null;
	}
}
