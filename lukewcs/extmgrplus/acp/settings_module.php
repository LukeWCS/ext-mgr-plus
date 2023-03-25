<?php
/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

namespace lukewcs\extmgrplus\acp;

class settings_module
{
	public $page_title;
	public $tpl_name;
	public $u_action;

	public function main()
	{
		global $phpbb_container;

		$language = $phpbb_container->get('language');
		$this->tpl_name = 'acp_ext_mgr_plus_settings';
		$this->page_title = $language->lang('EXTMGRPLUS_NAV_CONFIG');

		$acp_controller = $phpbb_container->get('lukewcs.extmgrplus.controller.acp');
		$acp_controller->set_page_url($this->u_action);
		$acp_controller->module_settings();
	}
}
