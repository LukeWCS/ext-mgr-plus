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

class v_1_1_1 extends \phpbb\db\migration\migration
{
	public static function depends_on()
	{
		return ['\lukewcs\extmgrplus\migrations\v_1_1_0'];
	}

	public function update_data()
	{
		return [
			['module.add', [
				'acp',
				'ACP_EXTENSION_MANAGEMENT', [
					'module_basename'	=> '\lukewcs\extmgrplus\acp\settings_module',
					'modes'				=> ['settings'],
				]
			]],
		];
	}
}
