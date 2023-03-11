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
	// language pack author
	'EXTMGRPLUS_LANG_DESC'					=> 'English',
	'EXTMGRPLUS_LANG_VER' 					=> '1.1.1',
	'EXTMGRPLUS_LANG_AUTHOR'	 			=> 'LukeWCS',

	// settings
	'EXTMGRPLUS_SECTION_SETTINGS'			=> 'Settings (Plus)',
	'EXTMGRPLUS_LOG'						=> 'Log entry',
	'EXTMGRPLUS_LOG_EXPLAIN'				=> 'Here you can specify whether an entry should be added to the administrator log for the actions “Enable selected” and “Disable selected”.',
	'EXTMGRPLUS_CONFIRMATION'				=> 'Confirmation',
	'EXTMGRPLUS_CONFIRMATION_EXPLAIN'		=> 'Here you can specify whether the actions “Enable selected” and “Disable selected” should be prompted and must be confirmed.',
	'EXTMGRPLUS_CHECKBOX_MODE'				=> 'Set check boxes',
	'EXTMGRPLUS_CHECKBOX_MODE_EXPLAIN'		=> 'If you select “Set all”, all check boxes are automatically set. If you choose “Remember last state”, the state of all checkboxes is saved when the “Enable selected” or “Disable selected” action is performed. In addition, the state of all checkboxes can also be saved via the “%s Save” link.',
	'EXTMGRPLUS_CHECKBOX_MODE_OFF'			=> 'Off',
	'EXTMGRPLUS_CHECKBOX_MODE_ALL'			=> 'Set all',
	'EXTMGRPLUS_CHECKBOX_MODE_LAST'			=> 'Remember last state',
	'EXTMGRPLUS_ORDER_AND_IGNORE'			=> 'Order and Ignore',
	'EXTMGRPLUS_ORDER_AND_IGNORE_EXPLAIN'	=> 'If you enable this option, the “Enable selected” action respects the Order group and the “Enable selected” and “Disable selected” actions respect the Ignore property.',
	'EXTMGRPLUS_SELF_DISABLE'				=> 'Allow self-deactivation',
	'EXTMGRPLUS_SELF_DISABLE_EXPLAIN'		=> 'If you enable this option, then “Extension Manager Plus” can also deactivate itself in the “Disable selected” action, since this extension can then be selected like any other.',

	// settings expert
	'EXTMGRPLUS_SECTION_EXPERT_SETTINGS'	=> 'Expert settings',
	'EXTMGRPLUS_MIGRATION_COL'				=> 'Show column with new migrations',
	'EXTMGRPLUS_MIGRATION_COL_EXPLAIN'		=> 'If this option is enabled, then an additional column is displayed in which the number of new migrations is listed. The number is displayed for both “Disabled Extensions” and “Not installed extensions”.',
	'EXTMGRPLUS_MIGRATIONS'					=> 'Allow extensions with new migrations',
	'EXTMGRPLUS_MIGRATIONS_EXPLAIN'			=> 'If this option is enabled, you can also activate those extensions for which there are new migrations with the “Enable selected” action. This applies to updated extensions that contain a “migrations” folder. Without this option, such extensions must be activated manually, which is recommended.',

	// settings reset
	'EXTMGRPLUS_SECTION_RESET'				=> 'Reset',
	'EXTMGRPLUS_DEFAULTS'					=> 'Reset settings',
	'EXTMGRPLUS_DEFAULTS_EXP'				=> 'Resets all settings to the installation standard. (Does not affect the “Order” and “Ignore columns”.)',
	'EXTMGRPLUS_BUTTON_DEFAULTS'			=> 'Defaults',

	// settings order and ignore
	'EXTMGRPLUS_ORDER'						=> 'Order',
	'EXTMGRPLUS_ORDER_EXPLAIN'				=> '%s This column allows you to define order groups in the range 0 to 99 for the “Enable selected” action. This allows extensions that other extensions depend on to be activated before them to avoid error messages. Extensions belonging to such a group are activated first, starting with group 0, then group 1 and so on. Extensions without a group are activated last.',
	'EXTMGRPLUS_IGNORE'						=> 'Ignore',
	'EXTMGRPLUS_IGNORE_EXPLAIN'				=> '%s This column allows you to specify which extensions should be ignored during the “Enable selected” and “Disable selected” actions. Ignored extensions can no longer be selected in the extensions list. If an order group was defined for an ignored extension, then this is retained, but it no longer has any meaning.',
	'EXTMGRPLUS_ORDER_AND_IGNORE_SAVE'		=> 'Save',

	// info table
	'EXTMGRPLUS_AVAILABLE_EXTENSIONS'		=> 'Total extensions',
	'EXTMGRPLUS_LAST_VERSIONCHECK'			=> 'Last version check',
	'EXTMGRPLUS_AVAILABLE_UPDATES'			=> 'Available updates',

	// ext manager
	'EXTMGRPLUS_ALL_DISABLE'				=> 'Disable selected',
	'EXTMGRPLUS_ALL_ENABLE'					=> 'Enable selected',
	'EXTMGRPLUS_EXTENSIONS_ENABLED'			=> 'Enabled Extensions: %u',
	'EXTMGRPLUS_EXTENSIONS_DISABLED'		=> 'Disabled Extensions: %u',
	'EXTMGRPLUS_EXTENSIONS_NOT_INSTALLED'	=> 'Not installed Extensions: %u',

	// tooltips
	'EXTMGRPLUS_TOOLTIP_HAS_MIGRATION'		=> 'This extension has new migrations that are applied when activating the extension.',
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
	'EXTMGRPLUS_MSG_CONFIRM_MIGRATIONS'		=> 'Are you sure you want to allow activation of extensions with new migrations?',
	'EXTMGRPLUS_MSG_SETTINGS_SAVED'			=> 'Settings saved successfully.',
	'EXTMGRPLUS_MSG_ORDER_AND_IGNORE_SAVED'	=> 'Order and Ignore columns saved successfully.',
	'EXTMGRPLUS_MSG_CHECKBOXES_SAVED'		=> 'Selection of checkboxes saved successfully.',
	'EXTMGRPLUS_MSG_PROCESS_ABORTED'		=> 'The “%s” operation was interrupted by the following extension:',
	'EXTMGRPLUS_MSG_DEACTIVATION'			=> '%1$u of %2$u enabled extensions have been disabled.',
	'EXTMGRPLUS_MSG_ACTIVATION'				=> '%1$u of %2$u disabled extensions have been enabled.',
	'EXTMGRPLUS_MSG_ACTIVATION_FAILED'		=> 'The following extensions could not be activated:',
	'EXTMGRPLUS_MSG_SAFE_TIME_EXCEEDED'		=> 'The tolerance range (%u seconds) of the maximum PHP execution time has been exceeded.',
	'EXTMGRPLUS_MSG_LANGUAGEPACK_OUTDATED'	=> 'Note: The language pack for the extension <strong>%1$s</strong> is no longer up-to-date. (installed: %2$s / needed: %3$s)',
	'EXTMGRPLUS_MSG_SELF_DISABLE'			=> 'Note: The “Extension Manager Plus” extension will also be disabled.',
]);
