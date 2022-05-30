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
	'EXTMGRPLUS_LANG_DESC'						=> 'Deutsch (Du)',
	'EXTMGRPLUS_LANG_EXT_VER' 					=> '1.0.0',
	'EXTMGRPLUS_LANG_AUTHOR' 					=> 'LukeWCS',

	// heading
	'EXTMGRPLUS_TITLE'							=> 'Erweiterungen verwalten (Plus)',

	// settings
	'EXTMGRPLUS_SETTINGS_TITLE'					=> 'Einstellungen (Plus)',
	'EXTMGRPLUS_LOG'							=> 'Log-Eintrag',
	'EXTMGRPLUS_LOG_EXPLAIN'					=> 'Hier kannst du festlegen, ob bei den Aktionen „Ausgewählte aktivieren“ und „Ausgewählte deaktivieren“ ein Eintrag im Administrator-Log hinzugefügt werden soll.',
	'EXTMGRPLUS_CONFIRMATION'					=> 'Rückfrage',
	'EXTMGRPLUS_CONFIRMATION_EXPLAIN'			=> 'Hier kannst du festlegen, ob bei den Aktionen „Ausgewählte aktivieren“ und „Ausgewählte deaktivieren“ eine Rückfrage erfolgen soll, die bestätigt werden muss.',

	// settings expert
	'EXTMGRPLUS_EXPERT_SETTINGS_TITLE'			=> 'Einstellungen (Plus) - Experten-Einstellungen',
	'EXTMGRPLUS_SELF_DISABLE'					=> 'Erlaube Eigendeaktivierung',
	'EXTMGRPLUS_SELF_DISABLE_EXPLAIN'			=> 'Wenn du diese Option aktivierst, dann kann sich „Extension Manager Plus“ bei der Aktion „Ausgewählte deaktivieren“ auch selbst deaktivieren, da diese Erweiterung dann wie jede andere ausgewählt werden kann.',
	'EXTMGRPLUS_MIGRATIONS'						=> 'Erlaube Migrationen',
	'EXTMGRPLUS_MIGRATIONS_EXPLAIN'				=> 'Wenn du diese Option aktivierst, dann können bei der Aktion „Ausgewählte aktivieren“ auch diejenigen Erweiterungen aktiviert werden, bei denen neue Migrationsdateien vorliegen. Das trifft auf aktualisierte Erweiterungen zu, die einen Ordner „migrations“ enthalten. Ohne diese Option müssen solche Erweiterungen manuell aktiviert werden, was empfohlen wird.',

	// ext manager
	'EXTMGRPLUS_ALL_DISABLE'					=> 'Ausgewählte deaktivieren',
	'EXTMGRPLUS_ALL_ENABLE'						=> 'Ausgewählte aktivieren',
	'EXTMGRPLUS_HAS_MIGRATION'					=> 'neue Migrationen',
	'EXTMGRPLUS_AVAILABLE_EXTENSIONS'			=> 'Verfügbare Erweiterungen',
	'EXTMGRPLUS_EXTENSIONS_NOT_INSTALLED'		=> 'Nicht installierte Erweiterungen',

	'EXTMGRPLUS_TOOLTIP_HAS_MIGRATION'			=> 'Diese Erweiterung hat neue Migrationsdateien, die beim aktivieren der Erweiterung übernommen werden.',
	'EXTMGRPLUS_TOOLTIP_BUTTON_DISABLE'			=> 'Alle ausgewählten Erweiterungen deaktivieren.',
	'EXTMGRPLUS_TOOLTIP_BUTTON_ENABLE'			=> 'Alle ausgewählten Erweiterungen aktivieren.',

	// misc
	'EXTMGRPLUS_EXTENSION_PLURAL'				=> [
													0 => "0 Erweiterungen",
													1 => "%u Erweiterung",
													2 => "%u Erweiterungen",
												],

	// messages
	'EXTMGRPLUS_MSG_CONFIRM_DISABLE'			=> 'Bist du dir sicher, dass du %s deaktivieren möchtest?',
	'EXTMGRPLUS_MSG_CONFIRM_ENABLE'				=> 'Bist du dir sicher, dass du %s aktivieren möchtest?',
	'EXTMGRPLUS_MSG_SETTINGS_SAVED'				=> 'ExtMgrPlus: Einstellungen erfolgreich gespeichert.',
	'EXTMGRPLUS_MSG_ACTIVATION_ABORTED'			=> 'ExtMgrPlus: Der Vorgang „Ausgewählte aktivieren“ wurde von folgender Erweiterung unterbrochen',
	'EXTMGRPLUS_MSG_DEACTIVATION_SUCCESFULL'	=> 'ExtMgrPlus: %1$u von %2$u aktivierten Erweiterungen wurden deaktiviert.',
	'EXTMGRPLUS_MSG_ACTIVATION_SUCCESFULL'		=> 'ExtMgrPlus: %1$u von %2$u deaktivierten Erweiterungen wurden aktiviert.',
	'EXTMGRPLUS_MSG_LANGUAGEPACK_OUTDATED'		=> 'Hinweis: Das Sprachpaket der Erweiterung <strong>%1$s</strong> ist nicht mehr aktuell. (vorhanden: %2$s / benötigt: %3$s)',
]);
