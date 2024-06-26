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

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ « » “ ” … „ “

$lang = array_merge($lang, [
	// navigation
	'EXTMGRPLUS_NAV_TITLE'				=> 'Extension Manager Plus',
	'EXTMGRPLUS_NAV_CONFIG'				=> 'Erweiterungen verwalten - Einstellungen',

	// log
	'EXTMGRPLUS_LOG_EXT_DISABLE_ALL'	=> '<strong>Erweiterungen verwalten (Plus)</strong><br>» %1$u von %2$u Erweiterungen deaktiviert',
	'EXTMGRPLUS_LOG_EXT_ENABLE_ALL'		=> '<strong>Erweiterungen verwalten (Plus)</strong><br>» %1$u von %2$u Erweiterungen aktiviert',

	// misc
	'EXTMGRPLUS_VERSION_STRING'			=> 'v%s',
]);
