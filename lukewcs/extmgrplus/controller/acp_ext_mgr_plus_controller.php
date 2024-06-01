<?php
/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

namespace lukewcs\extmgrplus\controller;

class acp_ext_mgr_plus_controller
{
	protected $common;
	protected $language;
	protected $template;
	protected $request;
	protected $config;

	protected $u_action;

	public function __construct(
		$common,
		\phpbb\language\language $language,
		\phpbb\template\template $template,
		\phpbb\request\request $request,
		\phpbb\config\config $config
	)
	{
		$this->common		= $common;
		$this->language		= $language;
		$this->template		= $template;
		$this->request		= $request;
		$this->config		= $config;
	}

	public function module_settings(): void
	{
		$notes = [];
		$this->language->add_lang('acp/extensions');
		$this->language->add_lang(['acp_ext_mgr_plus_settings', 'acp_ext_mgr_plus_lang_author'], 'lukewcs/extmgrplus');

		$this->common->set_this(
			$this->u_action
		);
		$this->common->set_template_vars('EXTMGRPLUS');

		$lang_outdated_msg = $this->common->lang_ver_check_msg('EXTMGRPLUS_LANG_VER', 'EXTMGRPLUS_MSG_LANGUAGEPACK_OUTDATED');
		if ($lang_outdated_msg)
		{
			$notes[] = $lang_outdated_msg;
		}

		if ($this->request->is_set_post('extmgrplus_save_settings'))
		{
			$this->common->check_form_key_error('lukewcs_extmgrplus');

			$this->config->set('extension_force_unstable'			, $this->request->variable('force_unstable', false));
			$this->config->set('extmgrplus_switch_log'				, $this->request->variable('extmgrplus_switch_log', 0));
			$this->config->set('extmgrplus_switch_confirmation'		, $this->request->variable('extmgrplus_switch_confirmation', 0));
			$this->config->set('extmgrplus_switch_auto_redirect'	, $this->request->variable('extmgrplus_switch_auto_redirect', 0));
			$this->config->set('extmgrplus_select_checkbox_mode'	, $this->request->variable('extmgrplus_select_checkbox_mode', 0));
			$this->config->set('extmgrplus_switch_order_and_ignore'	, $this->request->variable('extmgrplus_switch_order_and_ignore', 0));
			$this->config->set('extmgrplus_switch_instructions'		, $this->request->variable('extmgrplus_switch_instructions', 0));
			$this->config->set('extmgrplus_switch_self_disable'		, $this->request->variable('extmgrplus_switch_self_disable', 0));
			$this->config->set('extmgrplus_switch_migration_col'	, $this->request->variable('extmgrplus_switch_migration_col', 0));
			$this->config->set('extmgrplus_switch_migrations'		, $this->request->variable('extmgrplus_switch_migrations', 0));

			$this->common->trigger_error_($this->language->lang('EXTMGRPLUS_MSG_SETTINGS_SAVED'), E_USER_NOTICE);
		}

		$this->template->assign_vars([
			'EXTMGRPLUS_NOTES'							=> $notes,
			'FORCE_UNSTABLE'							=> $this->config['extension_force_unstable'],
			'EXTMGRPLUS_SWITCH_LOG'						=> $this->config['extmgrplus_switch_log'],
			'EXTMGRPLUS_SWITCH_CONFIRMATION'			=> $this->config['extmgrplus_switch_confirmation'],
			'EXTMGRPLUS_SWITCH_AUTO_REDIRECT'			=> $this->config['extmgrplus_switch_auto_redirect'],
			'EXTMGRPLUS_SELECT_CHECKBOX_MODE'			=> $this->config['extmgrplus_select_checkbox_mode'],
			'EXTMGRPLUS_SELECT_CHECKBOX_MODE_OPTIONS' => [
				'EXTMGRPLUS_CHECKBOX_MODE_OFF'			=> '0',
				'EXTMGRPLUS_CHECKBOX_MODE_ALL'			=> '1',
				'EXTMGRPLUS_CHECKBOX_MODE_LAST'			=> '2',
			],
			'EXTMGRPLUS_SWITCH_ORDER_AND_IGNORE'		=> $this->config['extmgrplus_switch_order_and_ignore'],
			'EXTMGRPLUS_SWITCH_INSTRUCTIONS'			=> $this->config['extmgrplus_switch_instructions'],
			'EXTMGRPLUS_SWITCH_SELF_DISABLE'			=> $this->config['extmgrplus_switch_self_disable'],
			'EXTMGRPLUS_SWITCH_MIGRATION_COL'			=> $this->config['extmgrplus_switch_migration_col'],
			'EXTMGRPLUS_SWITCH_MIGRATIONS'				=> $this->config['extmgrplus_switch_migrations'],
		]);

		add_form_key('lukewcs_extmgrplus');
	}

	public function set_page_url($u_action): void
	{
		$this->u_action = $u_action;
	}
}
