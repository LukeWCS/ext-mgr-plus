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
	'EXTMGRPLUS_LANG_DESC'							=> 'Deutsch (Sie)',
	'EXTMGRPLUS_LANG_EXT_VER' 						=> '1.0.3',
	'EXTMGRPLUS_LANG_AUTHOR'	 					=> 'LukeWCS',

	// heading
	'EXTMGRPLUS_TITLE'								=> 'Erweiterungen verwalten (Plus)',

	// settings
	'EXTMGRPLUS_SETTINGS_TITLE'						=> 'Einstellungen (Plus)',
	'EXTMGRPLUS_LOG'								=> 'Log-Eintrag',
	'EXTMGRPLUS_LOG_EXPLAIN'						=> 'Hier können Sie festlegen, ob bei den Aktionen „Ausgewählte aktivieren“ und „Ausgewählte deaktivieren“ ein Eintrag im Administrator-Log hinzugefügt werden soll.',
	'EXTMGRPLUS_CONFIRMATION'						=> 'Rückfrage',
	'EXTMGRPLUS_CONFIRMATION_EXPLAIN'				=> 'Hier können Sie festlegen, ob bei den Aktionen „Ausgewählte aktivieren“ und „Ausgewählte deaktivieren“ eine Rückfrage erfolgen soll, die bestätigt werden muss.',
	'EXTMGRPLUS_CHECKBOXES_ALL_SET'					=> 'Kontrollkästchen setzen',
	'EXTMGRPLUS_CHECKBOXES_ALL_SET_EXPLAIN'			=> 'Wenn Sie diese Option aktivieren, werden alle Kontrollkästchen automatisch gesetzt.',
	'EXTMGRPLUS_ORDER_AND_IGNORE'					=> 'Reihenfolge und Ignorieren',
	'EXTMGRPLUS_ORDER_AND_IGNORE_EXPLAIN'			=> 'Wenn Sie diese Option aktivieren, wird bei der Aktion „Ausgewählte aktivieren“ die Reihenfolge-Gruppe berücksichtigt und bei „Ausgewählte aktivieren“ und „Ausgewählte deaktivieren“ das Ignorieren-Merkmal.',
	'EXTMGRPLUS_SELF_DISABLE'						=> 'Erlaube Eigendeaktivierung',
	'EXTMGRPLUS_SELF_DISABLE_EXPLAIN'				=> 'Wenn Sie diese Option aktivieren, dann kann sich „Extension Manager Plus“ bei der Aktion „Ausgewählte deaktivieren“ auch selbst deaktivieren, da diese Erweiterung dann wie jede andere ausgewählt werden kann.',

	// settings expert
	'EXTMGRPLUS_EXPERT_SETTINGS_TITLE'				=> 'Experten-Einstellungen',
	'EXTMGRPLUS_MIGRATIONS'							=> 'Erlaube Migrationen',
	'EXTMGRPLUS_MIGRATIONS_EXPLAIN'					=> 'Wenn Sie diese Option aktivieren, dann können bei der Aktion „Ausgewählte aktivieren“ auch diejenigen Erweiterungen aktiviert werden, bei denen neue Migrationsdateien vorliegen. Das trifft auf aktualisierte Erweiterungen zu, die einen Ordner „migrations“ enthalten. Ohne diese Option müssen solche Erweiterungen manuell aktiviert werden, was empfohlen wird.',

	// order and ignore
	'EXTMGRPLUS_ORDER_EXPLAIN'						=> 'Reihenfolge: In dieser Spalte können Sie Reihenfolge-Gruppen im Bereich 0 bis 99 für die Aktivierung definieren. Damit können Erweiterungen, von denen andere Erweiterungen abhängig sind, vor diesen aktiviert werden, um Fehlermeldungen zu vermeiden. Erweiterungen die zu einer solchen Gruppe gehören, werden zuerst aktiviert und zwar beginnend bei Gruppe 0, dann Gruppe 1 und so weiter. Erweiterungen ohne Gruppe werden als letztes aktiviert.',
	'EXTMGRPLUS_IGNORE_EXPLAIN'						=> 'Ignorieren: In dieser Spalte können Sie festlegen, welche Erweiterungen sowohl bei Deaktivierung als auch Aktivierung ignoriert werden sollen. Ignorierte Erweiterungen können in der Erweiterungen-Liste nicht mehr ausgewählt werden. Wenn bei einer ignorierten Erweiterung eine Reihenfolge-Gruppe definiert wurde, dann bleibt diese erhalten, sie hat jedoch keine Bedeutung mehr.',
	'EXTMGRPLUS_ORDER_AND_IGNORE_SAVE'				=> 'Speichern',

	// ext manager
	'EXTMGRPLUS_ALL_DISABLE'						=> 'Ausgewählte deaktivieren',
	'EXTMGRPLUS_ALL_ENABLE'							=> 'Ausgewählte aktivieren',
	'EXTMGRPLUS_HAS_MIGRATION'						=> 'neue Migrationen',
	'EXTMGRPLUS_AVAILABLE_EXTENSIONS'				=> 'Verfügbare Erweiterungen',
	'EXTMGRPLUS_EXTENSIONS_NOT_INSTALLED'			=> 'Nicht installierte Erweiterungen',

	// tooltips
	'EXTMGRPLUS_TOOLTIP_HAS_MIGRATION'				=> 'Diese Erweiterung hat neue Migrationsdateien, die beim aktivieren der Erweiterung übernommen werden.',
	'EXTMGRPLUS_TOOLTIP_BUTTON_DISABLE'				=> 'Alle ausgewählten Erweiterungen deaktivieren.',
	'EXTMGRPLUS_TOOLTIP_BUTTON_ENABLE'				=> 'Alle ausgewählten Erweiterungen aktivieren.',
	'EXTMGRPLUS_TOOLTIP_ORDER'						=> 'Reihenfolge-Gruppe im Bereich 0-99.',
	'EXTMGRPLUS_TOOLTIP_IGNORE'						=> 'Erweiterung ignorieren.',
	'EXTMGRPLUS_TOOLTIP_SELECT_ALL'					=> 'Alle Erweiterungen auswählen oder abwählen.',
	'EXTMGRPLUS_TOOLTIP_SELECT'						=> 'Erweiterung auswählen.',

	// columns
	'EXTMGRPLUS_COL_MIGRATION_FILES'				=> 'Neue Migrationsdateien',
	'EXTMGRPLUS_COL_SELECT'							=> 'Auswählen',
	'EXTMGRPLUS_COL_ORDER'							=> 'Reihenfolge',
	'EXTMGRPLUS_COL_IGNORE'							=> 'Ignorieren',

	// misc
	'EXTMGRPLUS_LINK_ORDER_AND_IGNORE'				=> 'Reihenfolge/Ignorieren',
	'EXTMGRPLUS_EXTENSION_PLURAL' => [
													0 => "0 Erweiterungen",
													1 => "%u Erweiterung",
													2 => "%u Erweiterungen",
	],

	// messages
	'EXTMGRPLUS_MSG_CONFIRM_DISABLE'				=> 'Sind Sie sich sicher, dass Sie %s deaktivieren möchten?',
	'EXTMGRPLUS_MSG_CONFIRM_ENABLE'					=> 'Sind Sie sich sicher, dass Sie %s aktivieren möchten?',
	'EXTMGRPLUS_MSG_CONFIRM_MIGRATIONS'				=> 'Sind Sie sich sicher, dass Sie Migrationen erlauben möchten?',
	'EXTMGRPLUS_MSG_SETTINGS_SAVED'					=> 'ExtMgrPlus: Einstellungen erfolgreich gespeichert.',
	'EXTMGRPLUS_MSG_ORDER_AND_IGNORE_SAVED'			=> 'ExtMgrPlus: Spalten für Reihenfolge/Ignorieren erfolgreich gespeichert.',
	'EXTMGRPLUS_MSG_PROCESS_ABORTED'				=> 'ExtMgrPlus: Der Vorgang „%s“ wurde von folgender Erweiterung unterbrochen:',
	'EXTMGRPLUS_MSG_ACTIVATION_FAILED'				=> 'Die folgenden Erweiterungen konnten nicht aktiviert werden:',
	'EXTMGRPLUS_MSG_DEACTIVATION'					=> 'ExtMgrPlus: %1$u von %2$u aktivierten Erweiterungen wurden deaktiviert.',
	'EXTMGRPLUS_MSG_ACTIVATION'						=> 'ExtMgrPlus: %1$u von %2$u deaktivierten Erweiterungen wurden aktiviert.',
	'EXTMGRPLUS_MSG_LANGUAGEPACK_OUTDATED'			=> 'Hinweis: Das Sprachpaket der Erweiterung <strong>%1$s</strong> ist nicht mehr aktuell. (vorhanden: %2$s / benötigt: %3$s)',
]);
