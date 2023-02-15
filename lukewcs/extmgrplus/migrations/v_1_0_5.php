<?php
/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

namespace lukewcs\extmgrplus\migrations;

class v_1_0_5 extends \phpbb\db\migration\migration
{
	public static function depends_on()
	{
		return ['\lukewcs\extmgrplus\migrations\v_1_0_3'];
	}

	public function update_data()
	{
		return [
			['config.add',		['extmgrplus_enable_version_notification'	, 1]],
			['config_text.add', ['extmgrplus_version_check'					, '']],
		];
	}
}
