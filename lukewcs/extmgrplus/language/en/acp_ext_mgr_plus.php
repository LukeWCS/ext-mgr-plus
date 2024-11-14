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
	// info table
	'EXTMGRPLUS_COL_AVAILABLE_EXTENSIONS'	=> 'Available extensions',
	'EXTMGRPLUS_COL_WITH_VERSIONCHECK'		=> 'With version checking',
	'EXTMGRPLUS_COL_LAST_VERSIONCHECK'		=> 'Last version check',
	'EXTMGRPLUS_COL_AVAILABLE_UPDATES'		=> 'Available updates',
	'EXTMGRPLUS_AVAILABLE_EXTENSIONS' => [
		0									=> '%2$u',
		1									=> '%2$u (%1$u invalid)',
	],
	'EXTMGRPLUS_VERSIONCHECK_DATE' => [
		0									=> '%2$s (%3$u sec.)',
		1									=> '%2$s (%3$u sec. / %1$u error)',
		2									=> '%2$s (%3$u sec. / %1$u errors)',
	],

	// link bar
	'EXTMGRPLUS_LINK_ORDER_AND_IGNORE'		=> 'Order, Dependency, Ignore',
	'EXTMGRPLUS_LINK_SAVE_CHECKBOXES'		=> 'Save',

	// settings order and ignore
	'EXTMGRPLUS_SECTION_SETTINGS'			=> 'Settings (Plus)',
	'EXTMGRPLUS_ORDER'						=> '%s Order',
	'EXTMGRPLUS_ORDER_EXPLAIN_SHORT'		=> 'In this column, you can define order groups in the range 0 to 99 for the “Enable selected” and “Disable selected” actions.',
	'EXTMGRPLUS_ORDER_EXPLAIN'				=> 'This allows extensions that depend on other extensions to be activated before them to avoid error messages. Extensions that belong to such a group are activated first, starting with group 0, then group 1, and so on. Extensions without a group are activated last. When deactivating, the order is reversed.',
	'EXTMGRPLUS_DEPENDENCY'					=> 'Dependency',
	'EXTMGRPLUS_DEPENDENCY_EXPLAIN'			=> 'An extension can be linked to a group by preceding it with <code>+</code>. For example, if you have extension B which is dependent on extension A, you can enter <code>0</code> for A and <code>+0</code> for B. If both extensions are enabled, selecting A will also select B. If both extensions are disabled, selecting B will also select A.',
	'EXTMGRPLUS_IGNORE'						=> '%s Ignore',
	'EXTMGRPLUS_IGNORE_EXPLAIN_SHORT'		=> 'This column allows you to specify which extensions should be ignored during the “Enable selected” and “Disable selected” actions.',
	'EXTMGRPLUS_IGNORE_EXPLAIN'				=> 'Ignored extensions can no longer be selected in the extensions list and no new migrations will be detected and displayed for such extensions. If an order group was defined for an ignored extension, then this is retained, but it no longer has any meaning.',
	'EXTMGRPLUS_SPOILER_LABEL'				=> 'Further explanation',

	// ext manager
	'EXTMGRPLUS_COL_CDB'					=> 'Validated extension',
	'EXTMGRPLUS_COL_MIGRATIONS'				=> 'New migrations',
	'EXTMGRPLUS_COL_SELECT'					=> 'Select',
	'EXTMGRPLUS_COL_ORDER'					=> 'Order',
	'EXTMGRPLUS_COL_IGNORE'					=> 'Ignore',
	'EXTMGRPLUS_DISABLE_ALL'				=> 'Disable selected',
	'EXTMGRPLUS_ENABLE_ALL'					=> 'Enable selected',
	'EXTMGRPLUS_EXTENSIONS_ENABLED'			=> 'Enabled Extensions: %u',
	'EXTMGRPLUS_EXTENSIONS_DISABLED'		=> 'Disabled Extensions: %u',
	'EXTMGRPLUS_EXTENSIONS_NOT_INSTALLED'	=> 'Not installed Extensions: %u',

	// tooltips
	'EXTMGRPLUS_TOOLTIP_HAS_MIGRATION'		=> 'This extension has new migrations that are applied when activating the extension.',
	'EXTMGRPLUS_TOOLTIP_DISABLE_ALL'		=> 'Disable all selected extensions.',
	'EXTMGRPLUS_TOOLTIP_ENABLE_ALL'			=> 'Enable all selected extensions.',
	'EXTMGRPLUS_TOOLTIP_ORDER'				=> 'Order group in the range 0-99. A group can be linked with a preceding +.',
	'EXTMGRPLUS_TOOLTIP_IGNORE'				=> 'Ignore extension.',
	'EXTMGRPLUS_TOOLTIP_SELECT_ALL'			=> 'Select or deselect all extensions.',
	'EXTMGRPLUS_TOOLTIP_SELECT'				=> 'Select extension.',
	'EXTMGRPLUS_TOOLTIP_IS_LOCKED'			=> 'The selection of this extension is blocked due to new migrations.',
	// tooltips icons
	'EXTMGRPLUS_TOOLTIP_CDB_EXT'			=> 'This extension has been officially validated.',
	'EXTMGRPLUS_TOOLTIP_OUTDATED'			=> 'The installed version of this extension is out of date.',
	'EXTMGRPLUS_TOOLTIP_VERSIONCHECK_ERROR'	=> 'An error occurred during the version check. Click on “Details” to find out more.',
	'EXTMGRPLUS_TOOLTIP_VERSIONCHECK_EMPTY'	=> 'No version check was performed for this extension.',
	'EXTMGRPLUS_TOOLTIP_NO_VERSIONCHECK'	=> 'This extension does not provide version checking.',
	'EXTMGRPLUS_TOOLTIP_IS_IGNORED'			=> 'This extension is ignored by “Extension Manager Plus”.',

	// misc
	'EXTMGRPLUS_EXTENSION_PLURAL' => [
		0									=> '0 extensions',
		1									=> '1 extension',
		2									=> '%u extensions',
	],
	'EXTMGRPLUS_SECOND_PLURAL' => [
		0									=> '0 seconds',
		1									=> '1 second',
		2									=> '%u seconds',
	],

	// details
	'EXTMGRPLUS_SECTION_DETAILS'			=> 'Information from Extension Manager Plus',
	'EXTMGRPLUS_DETAILS_CDB_PAGE'			=> 'phpBB extension database page',
	'EXTMGRPLUS_DETAILS_VERSION_URL'		=> 'Link to version file',

	// messages
	'EXTMGRPLUS_MSG_CONFIRM_DISABLE'		=> 'Are you sure that you wish to disable %s?',
	'EXTMGRPLUS_MSG_CONFIRM_ENABLE'			=> 'Are you sure that you wish to enable %s?',
	'EXTMGRPLUS_MSG_ORDER_AND_IGNORE_SAVED'	=> 'Order and Ignore columns saved successfully.',
	'EXTMGRPLUS_MSG_CHECKBOXES_SAVED'		=> 'Selection of checkboxes saved successfully.',
	'EXTMGRPLUS_MSG_PROCESS_ABORTED'		=> 'The “%s” operation was interrupted by the following extension:',
	'EXTMGRPLUS_MSG_DEACTIVATION'			=> '%1$u of %2$u extensions have been disabled.',
	'EXTMGRPLUS_MSG_ACTIVATION'				=> '%1$u of %2$u extensions have been enabled.',
	'EXTMGRPLUS_MSG_DEACTIVATION_FAILED'	=> 'The following extensions could not be disabled:',
	'EXTMGRPLUS_MSG_ACTIVATION_FAILED'		=> 'The following extensions could not be enabled:',
	'EXTMGRPLUS_MSG_SAFE_TIME_EXCEEDED'		=> 'The tolerance range (%u seconds) of the maximum PHP execution time has been exceeded.',
	'EXTMGRPLUS_MSG_SELF_DISABLE'			=> 'Note: The “Extension Manager Plus” extension will also be disabled.',
	// messages versioncheck
	'EXTMGRPLUS_MSG_VERSIONCHECK_HINT'		=> 'The extensions are being checked for new versions.',
	'EXTMGRPLUS_MSG_VERSIONCHECK_BLOCK'		=> 'Current block (maximum %s)',
	'EXTMGRPLUS_MSG_VERSIONCHECK_PROGRESS'	=> 'Extensions checked: %1$u / %2$u',
]);
