<?php
/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org
* @license GNU General Public License, version 2 (GPL-2.0-only)
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
	// settings order and ignore
	'EXTMGRPLUS_SECTION_SETTINGS'			=> 'Settings (Plus)',
	'EXTMGRPLUS_ORDER'						=> 'Order',
	'EXTMGRPLUS_ORDER_EXPLAIN'				=> '%s This column allows you to define order groups in the range 0 to 99 for the “Enable selected” action. This allows extensions that other extensions depend on to be activated before them to avoid error messages. Extensions belonging to such a group are activated first, starting with group 0, then group 1 and so on. Extensions without a group are activated last.',
	'EXTMGRPLUS_IGNORE'						=> 'Ignore',
	'EXTMGRPLUS_IGNORE_EXPLAIN'				=> '%s This column allows you to specify which extensions should be ignored during the “Enable selected” and “Disable selected” actions. Ignored extensions can no longer be selected in the extensions list. If an order group was defined for an ignored extension, then this is retained, but it no longer has any meaning.',

	// info table
	'EXTMGRPLUS_AVAILABLE_EXTENSIONS'		=> 'Total extensions',
	'EXTMGRPLUS_WITH_VERSIONCHECK'			=> 'With version checking',
	'EXTMGRPLUS_LAST_VERSIONCHECK'			=> 'Last version check',
	'EXTMGRPLUS_AVAILABLE_UPDATES'			=> 'Available updates',
	'EXTMGRPLUS_VERSIONCHECK_DATE'			=> '%1$s (%2$s errors)',

	// ext manager
	'EXTMGRPLUS_ALL_DISABLE'				=> 'Disable selected',
	'EXTMGRPLUS_ALL_ENABLE'					=> 'Enable selected',
	'EXTMGRPLUS_EXTENSIONS_ENABLED'			=> 'Enabled Extensions: %u',
	'EXTMGRPLUS_EXTENSIONS_DISABLED'		=> 'Disabled Extensions: %u',
	'EXTMGRPLUS_EXTENSIONS_NOT_INSTALLED'	=> 'Not installed Extensions: %u',

	// tooltips
	'EXTMGRPLUS_TOOLTIP_HAS_MIGRATION'		=> 'This extension has new migrations that are applied when activating the extension.',
	'EXTMGRPLUS_TOOLTIP_OUTDATED'			=> 'The installed version of this extension is out of date.',
	'EXTMGRPLUS_TOOLTIP_VERSIONCHECK_ERROR'	=> 'An error occurred during the version check. Click on “Details” to find out more.',
	'EXTMGRPLUS_TOOLTIP_NO_VERSIONCHECK'	=> 'This extension does not provide version checking.',
	'EXTMGRPLUS_TOOLTIP_IS_IGNORED'			=> 'This extension is ignored by “Extension Manager Plus”.',
	'EXTMGRPLUS_TOOLTIP_IS_LOCKED'			=> 'The selection of this extension is blocked due to new migrations.',
	'EXTMGRPLUS_TOOLTIP_BUTTON_DISABLE'		=> 'Disable all selected extensions.',
	'EXTMGRPLUS_TOOLTIP_BUTTON_ENABLE'		=> 'Enable all selected extensions.',
	'EXTMGRPLUS_TOOLTIP_ORDER'				=> 'Order group in the range 0-99.',
	'EXTMGRPLUS_TOOLTIP_IGNORE'				=> 'Ignore extension.',
	'EXTMGRPLUS_TOOLTIP_SELECT_ALL'			=> 'Select or deselect all extensions.',
	'EXTMGRPLUS_TOOLTIP_SELECT'				=> 'Select extension.',

	// columns
	'EXTMGRPLUS_COL_MIGRATIONS'				=> 'New migrations',
	'EXTMGRPLUS_COL_SELECT'					=> 'Select',
	'EXTMGRPLUS_COL_ORDER'					=> 'Order',
	'EXTMGRPLUS_COL_IGNORE'					=> 'Ignore',

	// link bar
	'EXTMGRPLUS_LINK_ORDER_AND_IGNORE'		=> 'Order & Ignore',
	'EXTMGRPLUS_LINK_SAVE_CHECKBOXES'		=> 'Save',

	// misc
	'EXTMGRPLUS_EXTENSION_PLURAL' => [
		0									=> '0 extensions',
		1									=> '1 extension',
		2									=> '%u extensions',
	],

	// messages
	'EXTMGRPLUS_MSG_CONFIRM_DISABLE'		=> 'Are you sure that you wish to disable %s?',
	'EXTMGRPLUS_MSG_CONFIRM_ENABLE'			=> 'Are you sure that you wish to enable %s?',
	'EXTMGRPLUS_MSG_ORDER_AND_IGNORE_SAVED'	=> 'Order and Ignore columns saved successfully.',
	'EXTMGRPLUS_MSG_CHECKBOXES_SAVED'		=> 'Selection of checkboxes saved successfully.',
	'EXTMGRPLUS_MSG_PROCESS_ABORTED'		=> 'The “%s” operation was interrupted by the following extension:',
	'EXTMGRPLUS_MSG_DEACTIVATION'			=> '%1$u of %2$u extensions have been disabled.',
	'EXTMGRPLUS_MSG_ACTIVATION'				=> '%1$u of %2$u extensions have been enabled.',
	'EXTMGRPLUS_MSG_ACTIVATION_FAILED'		=> 'The following extensions could not be activated:',
	'EXTMGRPLUS_MSG_SAFE_TIME_EXCEEDED'		=> 'The tolerance range (%u seconds) of the maximum PHP execution time has been exceeded.',
	'EXTMGRPLUS_MSG_SELF_DISABLE'			=> 'Note: The “Extension Manager Plus” extension will also be disabled.',
]);
