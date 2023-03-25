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

class settings_info
{
	public function module()
	{
		return [
			'filename'	=> '\lukewcs\extmgrplus\acp\settings_module',
			'title'		=> 'EXTMGRPLUS_NAV_TITLE',
			'modes'		=> [
				'settings'	=> [
					'title'	=> 'EXTMGRPLUS_NAV_CONFIG',
					'auth'	=> 'ext_lukewcs/extmgrplus && acl_a_extensions',
					'cat'	=> ['ACP_EXTENSION_MANAGEMENT'],
				],
			],
		];
	}
}
