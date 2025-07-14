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

namespace lukewcs\extmgrplus\controller;

class acp_ext_mgr_plus_controller
{
	// protected object $common;
	// protected object $language;
	// protected object $template;
	// protected object $request;
	// protected object $config;

	// protected string $u_action;

	// public function __construct(
		// $common,
		// \phpbb\language\language $language,
		// \phpbb\template\template $template,
		// \phpbb\request\request $request,
		// \phpbb\config\config $config,
	// )
	// {
		// $this->common	= $common;
		// $this->language	= $language;
		// $this->template	= $template;
		// $this->request	= $request;
		// $this->config	= $config;
	// }
	protected string $u_action;

	public function __construct(
		protected object $common,
		protected \phpbb\language\language $language,
		protected \phpbb\template\template $template,
		protected \phpbb\request\request $request,
		protected \phpbb\config\config $config,
	)
	{
	}

	public function module_settings(): void
	{
		$notes = [];
		$this->language->add_lang('acp/extensions');
		$this->language->add_lang(['acp_ext_mgr_plus_settings', 'acp_ext_mgr_plus_lang_author'], 'lukewcs/extmgrplus');

		$this->common->u_action = $this->u_action;
		$this->common->set_meta_template_vars('EXTMGRPLUS', 'LukeWCS');

		$lang_outdated_msg = $this->common->lang_ver_check_msg('EXTMGRPLUS_LANG_VER', 'EXTMGRPLUS_MSG_LANGUAGEPACK_OUTDATED');
		if ($lang_outdated_msg)
		{
			$notes[] = $lang_outdated_msg;
		}

		if ($this->request->is_set_post('extmgrplus_save_settings'))
		{
			$this->common->check_form_key_('lukewcs_extmgrplus');

			$this->config->set('extension_force_unstable'			, $this->request->variable('force_unstable'						, false));
			$this->config->set('extmgrplus_switch_log'				, $this->request->variable('extmgrplus_switch_log'				, 0));
			$this->config->set('extmgrplus_switch_confirmation'		, $this->request->variable('extmgrplus_switch_confirmation'		, 0));
			$this->config->set('extmgrplus_switch_auto_redirect'	, $this->request->variable('extmgrplus_switch_auto_redirect'	, 0));
			$this->config->set('extmgrplus_select_checkbox_mode'	, $this->request->variable('extmgrplus_select_checkbox_mode'	, 0));
			$this->config->set('extmgrplus_switch_order_and_ignore'	, $this->request->variable('extmgrplus_switch_order_and_ignore'	, 0));
			$this->config->set('extmgrplus_switch_self_disable'		, $this->request->variable('extmgrplus_switch_self_disable'		, 0));
			$this->config->set('extmgrplus_switch_instructions'		, $this->request->variable('extmgrplus_switch_instructions'		, 0));
			$this->config->set('extmgrplus_switch_settings_link'	, $this->request->variable('extmgrplus_switch_settings_link'	, 0));
			$this->config->set('extmgrplus_number_vc_limit'			, $this->request->variable('extmgrplus_number_vc_limit'			, 0));
			$this->config->set('extmgrplus_switch_migration_col'	, $this->request->variable('extmgrplus_switch_migration_col'	, 0));
			$this->config->set('extmgrplus_switch_migrations'		, $this->request->variable('extmgrplus_switch_migrations'		, 0));
			$this->config->set('extmgrplus_switch_version_url'		, $this->request->variable('extmgrplus_switch_version_url'		, 0));

			$this->common->trigger_error_($this->language->lang('EXTMGRPLUS_MSG_SETTINGS_SAVED'), E_USER_NOTICE);
		}

		$this->template->assign_vars([
			'EXTMGRPLUS_NOTES'							=> $notes,
			'FORCE_UNSTABLE'							=> (bool) $this->config['extension_force_unstable'],
			'EXTMGRPLUS_SWITCH_LOG'						=> (bool) $this->config['extmgrplus_switch_log'],
			'EXTMGRPLUS_SWITCH_CONFIRMATION'			=> (bool) $this->config['extmgrplus_switch_confirmation'],
			'EXTMGRPLUS_SWITCH_AUTO_REDIRECT'			=> (bool) $this->config['extmgrplus_switch_auto_redirect'],
			'EXTMGRPLUS_SELECT_CHECKBOX_MODE_OPTIONS'	=> $this->select_struct((int) $this->config['extmgrplus_select_checkbox_mode'], [
				'EXTMGRPLUS_CHECKBOX_MODE_OFF'			=> 0,
				'EXTMGRPLUS_CHECKBOX_MODE_ALL'			=> 1,
				'EXTMGRPLUS_CHECKBOX_MODE_LAST'			=> 2,
			]),
			'EXTMGRPLUS_SWITCH_ORDER_AND_IGNORE'		=> (bool) $this->config['extmgrplus_switch_order_and_ignore'],
			'EXTMGRPLUS_SWITCH_SELF_DISABLE'			=> (bool) $this->config['extmgrplus_switch_self_disable'],
			'EXTMGRPLUS_SWITCH_INSTRUCTIONS'			=> (bool) $this->config['extmgrplus_switch_instructions'],
			'EXTMGRPLUS_SWITCH_SETTINGS_LINK'			=> (bool) $this->config['extmgrplus_switch_settings_link'],
			'EXTMGRPLUS_NUMBER_VC_LIMIT'				=> (int) $this->config['extmgrplus_number_vc_limit'],
			'EXTMGRPLUS_SWITCH_MIGRATION_COL'			=> (bool) $this->config['extmgrplus_switch_migration_col'],
			'EXTMGRPLUS_SWITCH_MIGRATIONS'				=> (bool) $this->config['extmgrplus_switch_migrations'],
			'EXTMGRPLUS_SWITCH_VERSION_URL'				=> (bool) $this->config['extmgrplus_switch_version_url'],
		]);

		add_form_key('lukewcs_extmgrplus');
	}

	public function set_page_url(string $u_action): void
	{
		$this->u_action = $u_action;
	}

	private function select_struct($cfg_value, array $options): array
	{
		$options_tpl = [];

		foreach ($options as $opt_key => $opt_value)
		{
			if (!is_array($opt_value))
			{
				$opt_value = [$opt_value];
			}
			$options_tpl[] = [
				'label'		=> $opt_key,
				'value'		=> $opt_value[0],
				'bold'		=> $opt_value[1] ?? false,
				'selected'	=> is_array($cfg_value) ? in_array($opt_value[0], $cfg_value) : $opt_value[0] == $cfg_value,
			];
		}

		return $options_tpl;
	}
}
