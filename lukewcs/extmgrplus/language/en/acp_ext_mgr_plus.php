<?php
/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org/
* @license GNU General Public License, version 2 (GPL-2.0)
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
	'EXTMGRPLUS_LANG_DESC'						=> 'English',
	'EXTMGRPLUS_LANG_EXT_VER' 					=> '1.0.0',
	'EXTMGRPLUS_LANG_AUTHOR'	 				=> 'LukeWCS',

	// heading
	'EXTMGRPLUS_TITLE'							=> 'Extensions Manager Plus',

	// settings
	'EXTMGRPLUS_SETTINGS_TITLE'					=> 'Settings (Plus)',
	'EXTMGRPLUS_LOG'							=> 'Log entry',
	'EXTMGRPLUS_LOG_EXPLAIN'					=> 'Here you can specify whether an entry should be added to the administrator log for the actions "Enable selected" and "Disable selected".',
	'EXTMGRPLUS_CONFIRMATION'					=> 'Confirmation',
	'EXTMGRPLUS_CONFIRMATION_EXPLAIN'			=> 'Here you can specify whether the actions "Enable selected" and "Disable selected" should be prompted and must be confirmed.',
	'EXTMGRPLUS_CHECKBOXES_ALL_SET'				=> 'Set ceck boxes',
	'EXTMGRPLUS_CHECKBOXES_ALL_SET_EXPLAIN'		=> 'If this option is activated, all checkboxes will be checked automatically.',
	'EXTMGRPLUS_SELF_DISABLE'					=> 'Allow self-deactivation',
	'EXTMGRPLUS_SELF_DISABLE_EXPLAIN'			=> 'If you activate this option, then "Extension Manager Plus" can also deactivate itself in the "Disable selected" action, since this extension can then be selected like any other.',

	// settings expert
	'EXTMGRPLUS_EXPERT_SETTINGS_TITLE'			=> 'Expert settings',
	'EXTMGRPLUS_MIGRATIONS'						=> 'Allow migrations',
	'EXTMGRPLUS_MIGRATIONS_EXPLAIN'				=> 'This option is not without risk! If you activate this option, the "Enable selected" action can also activate those extensions that have new migration files. This applies to upgraded extensions that contain a "migrations" folder. However, updated extensions that contain an invalid migration may throw a fatal exception error that cannot be caught. As a result, it is not possible to display a controlled error message. It is recommended to leave this option disabled.',

	// order and ignore
	'EXTMGRPLUS_ORDER_AND_IGNORE'				=> 'Order and Ignore',
	'EXTMGRPLUS_ORDER_EXPLAIN'					=> 'In the right column of the extensions list you can define order groups in the range 0 to 99 for activation. This allows extensions that other extensions depend on to be activated before them to avoid error messages. Extensions belonging to such a group are activated first, starting with group 0, then group 1 and so on. The same group can be defined for any number of extensions.',
	'EXTMGRPLUS_IGNORE_EXPLAIN'					=> 'In addition, there is the option of ignoring an extension for both deactivation and activation by defining the hyphen "-" instead of a number. In this case, the associated check box is disabled.',
	'EXTMGRPLUS_ORDER_AND_IGNORE_SAVE'			=> 'Save column',

	// ext manager
	'EXTMGRPLUS_ALL_DISABLE'					=> 'Disable selected',
	'EXTMGRPLUS_ALL_ENABLE'						=> 'Enable selected',
	'EXTMGRPLUS_HAS_MIGRATION'					=> 'new migrations',
	'EXTMGRPLUS_AVAILABLE_EXTENSIONS'			=> 'Available extensions',
	'EXTMGRPLUS_EXTENSIONS_NOT_INSTALLED'		=> 'Not installed extensions',

	'EXTMGRPLUS_TOOLTIP_HAS_MIGRATION'			=> 'This extension has new migration files that are applied when activating the extension.',
	'EXTMGRPLUS_TOOLTIP_BUTTON_DISABLE'			=> 'Disable all selected extensions.',
	'EXTMGRPLUS_TOOLTIP_BUTTON_ENABLE'			=> 'Enable all selected extensions.',
	'EXTMGRPLUS_TOOLTIP_ORDER_AND_IGNORE'		=> 'Order group in the range 0-99 or a hyphen "-" to ignore the extension.',

	'EXTMGRPLUS_COL_MIGRATION_FILES'			=> 'New migration files',
	'EXTMGRPLUS_COL_SELECT'						=> 'Select',
	'EXTMGRPLUS_COL_ORDER_AND_IGNORE'			=> 'Order/Ignore',

	// misc
	'EXTMGRPLUS_EXTENSION_PLURAL'				=> [
													0 => "0 extensions",
													1 => "%u extension",
													2 => "%u extensions",
												],

	// messages
	'EXTMGRPLUS_MSG_CONFIRM_DISABLE'			=> 'Are you sure that you wish to disable %s?',
	'EXTMGRPLUS_MSG_CONFIRM_ENABLE'				=> 'Are you sure that you wish to enable %s?',
	'EXTMGRPLUS_MSG_CONFIRM_MIGRATIONS'			=> 'Are you sure you want to allow migrations?',
	'EXTMGRPLUS_MSG_SETTINGS_SAVED'				=> 'ExtMgrPlus: Settings saved successfully.',
	'EXTMGRPLUS_MSG_ORDER_AND_IGNORE_SAVED'		=> 'ExtMgrPlus: Column for order and ignore saved successfully.',
	'EXTMGRPLUS_MSG_ACTIVATION_ABORTED'			=> 'ExtMgrPlus: The "Enable selected" operation was interrupted by the following extension',
	'EXTMGRPLUS_MSG_DEACTIVATION_SUCCESFULL'	=> 'ExtMgrPlus: %1$u of %2$u enabled extensions have been disabled.',
	'EXTMGRPLUS_MSG_ACTIVATION_SUCCESFULL'		=> 'ExtMgrPlus: %1$u of %2$u disabled extensions have been enabled.',
	'EXTMGRPLUS_MSG_LANGUAGEPACK_OUTDATED'		=> 'Note: The language pack for the extension <strong>%1$s</strong> is no longer up-to-date. (installed: %2$s / needed: %3$s)',
]);
