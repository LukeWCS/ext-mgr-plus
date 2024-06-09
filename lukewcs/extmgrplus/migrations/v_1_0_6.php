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

class v_1_0_6 extends \phpbb\db\migration\migration
{
	public static function depends_on()
	{
		return ['\lukewcs\extmgrplus\migrations\v_1_0_5'];
	}

	public function update_data()
	{
		return [
			['config.remove', ['extmgrplus_enable_version_notification']],
		];
	}
}
