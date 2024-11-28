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

class v_3_0_0 extends \phpbb\db\migration\migration
{
	public static function depends_on()
	{
		return ['\lukewcs\extmgrplus\migrations\v_2_0_1'];
	}

	public function update_data()
	{
		return [
			['config.add', 			['extmgrplus_number_vc_limit'		, 15]],
			['config.add', 			['extmgrplus_switch_version_url'	, 0]],

			['config.remove',		['extmgrplus_exec_todo']],

			['config_text.remove',	['extmgrplus_todo']],
		];
	}
}
