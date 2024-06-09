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

namespace lukewcs\extmgrplus\migrations;

class v_1_0_0 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['extmgrplus_enable_log']);
	}

	public static function depends_on()
	{
		return ['\phpbb\db\migration\data\v32x\v329'];
	}

	public function update_data()
	{
		return [
			['config.add',		['extmgrplus_enable_log'				, 1]],
			['config.add',		['extmgrplus_enable_confirmation'		, 1]],
			['config.add',		['extmgrplus_enable_checkboxes_all_set'	, 1]],
			['config.add',		['extmgrplus_enable_order_and_ignore'	, 1]],
			['config.add',		['extmgrplus_enable_self_disable'		, 0]],
			['config.add',		['extmgrplus_enable_migrations'			, 0]],
			['config_text.add', ['extmgrplus_todo_list'					, '']],
			['config_text.add', ['extmgrplus_order_and_ignore_list'		, '']],
		];
	}
}
