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
	// settings
	'EXTMGRPLUS_SECTION_SETTINGS'			=> 'Settings (Plus)',
	'EXTMGRPLUS_LOG'						=> 'Log entry',
	'EXTMGRPLUS_LOG_EXPLAIN'				=> 'Here you can specify whether an entry should be added to the administrator log for the actions “Enable selected” and “Disable selected”.',
	'EXTMGRPLUS_CONFIRMATION'				=> 'Confirmation',
	'EXTMGRPLUS_CONFIRMATION_EXPLAIN'		=> 'Here you can specify whether the actions “Enable selected” and “Disable selected” should be prompted and must be confirmed.',
	'EXTMGRPLUS_AUTO_REDIRECT'				=> 'Automatically confirm messages',
	'EXTMGRPLUS_AUTO_REDIRECT_EXPLAIN'		=> 'Here you can specify whether positive messages should be automatically confirmed. Error messages still have to be confirmed manually.',
	'EXTMGRPLUS_CHECKBOX_MODE'				=> 'Set check boxes',
	'EXTMGRPLUS_CHECKBOX_MODE_EXPLAIN'		=> 'If you select “Set all”, all check boxes are automatically set. If you choose “Remember last state”, the state of all checkboxes is saved when the “Enable selected” or “Disable selected” action is performed. In addition, the state of all checkboxes can also be saved via the “%s Save” link.',
	'EXTMGRPLUS_CHECKBOX_MODE_OFF'			=> 'Off',
	'EXTMGRPLUS_CHECKBOX_MODE_ALL'			=> 'Set all',
	'EXTMGRPLUS_CHECKBOX_MODE_LAST'			=> 'Remember last state',
	'EXTMGRPLUS_ORDER_AND_IGNORE'			=> 'Order, dependency and ignore',
	'EXTMGRPLUS_ORDER_AND_IGNORE_EXPLAIN'	=> 'If you enable this option, the “Enable selected” action respects the Order group and the “Enable selected” and “Disable selected” actions respect the Ignore property. In addition, defined dependencies are also taken into account when selecting/deselecting.',
	'EXTMGRPLUS_SELF_DISABLE'				=> 'Allow self-deactivation',
	'EXTMGRPLUS_SELF_DISABLE_EXPLAIN'		=> 'If you enable this option, then “Extension Manager Plus” can also deactivate itself in the “Disable selected” action, since this extension can then be selected like any other.',
	'EXTMGRPLUS_INSTRUCTIONS'				=> 'View instructions',
	'EXTMGRPLUS_INSTRUCTIONS_EXPLAIN'		=> 'This option allows you to choose whether to display the install, update, and uninstall instructions at the end of the extensions list.',
	'EXTMGRPLUS_VC_LIMIT'					=> 'Divide execution time of the version check',
	'EXTMGRPLUS_VC_LIMIT_EXPLAIN'			=> 'The version check is executed in blocks and with this value you can specify the maximum length of a single block of the version check. This prevents PHP or database time limits from being exceeded.',

	// settings expert
	'EXTMGRPLUS_SECTION_EXPERT_SETTINGS'	=> 'Expert settings',
	'EXTMGRPLUS_MIGRATION_COL'				=> 'Show column with new migrations',
	'EXTMGRPLUS_MIGRATION_COL_EXPLAIN'		=> 'If this option is enabled, then an additional column is displayed in which the number of new migrations is listed. The number is displayed for both “Disabled Extensions” and “Not installed extensions”.',
	'EXTMGRPLUS_MIGRATIONS'					=> 'Allow extensions with new migrations',
	'EXTMGRPLUS_MIGRATIONS_EXPLAIN'			=> 'If this option is enabled, you can also activate those extensions for which there are new migrations with the “Enable selected” action. This applies to updated extensions that contain a “migrations” folder. Without this option, such extensions must be activated manually, which is recommended.',
	'EXTMGRPLUS_VERSION_URL'				=> 'Show link to version file',
	'EXTMGRPLUS_VERSION_URL_EXPLAIN'		=> 'If you activate this option, you can display the link to the version file on the “Details” page of an extension, which is loaded and evaluated by phpBB from the respective server during a version check. Primarily interesting for extension developers.',

	// settings reset
	'EXTMGRPLUS_SECTION_RESET'				=> 'Reset',
	'EXTMGRPLUS_DEFAULTS'					=> 'Reset settings',
	'EXTMGRPLUS_DEFAULTS_EXP'				=> 'Resets all settings to the installation standard. (Does not affect the “Order” and “Ignore” columns.)',
	'EXTMGRPLUS_BUTTON_DEFAULTS'			=> 'Defaults',

	// messages
	'EXTMGRPLUS_MSG_CONFIRM_MIGRATIONS'		=> 'Are you sure you want to allow activation of extensions with new migrations?',
	'EXTMGRPLUS_MSG_SETTINGS_SAVED'			=> 'Settings saved successfully.',
]);
