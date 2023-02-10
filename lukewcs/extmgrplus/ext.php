<?php
/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

namespace lukewcs\extmgrplus;

class ext extends \phpbb\extension\base
{
	public function is_enableable()
	{
		$valid_phpbb = phpbb_version_compare(PHPBB_VERSION, '3.2.11', '>=') && phpbb_version_compare(PHPBB_VERSION, '3.4.0', '<');
		$valid_php = phpbb_version_compare(PHP_VERSION, '7.1.0', '>=') && phpbb_version_compare(PHP_VERSION, '8.3.0', '<');

		return ($valid_phpbb && $valid_php);
	}
}
