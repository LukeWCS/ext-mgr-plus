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
	'EXTMGRPLUS_SECTION_SETTINGS'			=> 'Einstellungen (Plus)',
	'EXTMGRPLUS_ORDER'						=> 'Reihenfolge',
	'EXTMGRPLUS_ORDER_EXPLAIN'				=> '%s In dieser Spalte kannst du Reihenfolge-Gruppen im Bereich 0 bis 99 für die Aktion „Ausgewählte aktivieren“ definieren. Damit können Erweiterungen, von denen andere Erweiterungen abhängig sind, vor diesen aktiviert werden, um Fehlermeldungen zu vermeiden. Erweiterungen die zu einer solchen Gruppe gehören, werden zuerst aktiviert und zwar beginnend bei Gruppe 0, dann Gruppe 1 und so weiter. Erweiterungen ohne Gruppe werden als letztes aktiviert.',
	'EXTMGRPLUS_IGNORE'						=> 'Ignorieren',
	'EXTMGRPLUS_IGNORE_EXPLAIN'				=> '%s In dieser Spalte kannst du festlegen, welche Erweiterungen bei den Aktionen „Ausgewählte aktivieren“ und „Ausgewählte deaktivieren“ ignoriert werden sollen. Ignorierte Erweiterungen können in der Erweiterungen-Liste nicht mehr ausgewählt werden. Wenn bei einer ignorierten Erweiterung eine Reihenfolge-Gruppe definiert wurde, dann bleibt diese erhalten, sie hat jedoch keine Bedeutung mehr.',
	'EXTMGRPLUS_ORDER_AND_IGNORE_SAVE'		=> 'Speichern',

	// info table
	'EXTMGRPLUS_AVAILABLE_EXTENSIONS'		=> 'Erweiterungen gesamt',
	'EXTMGRPLUS_LAST_VERSIONCHECK'			=> 'Letzte Versionsprüfung',
	'EXTMGRPLUS_AVAILABLE_UPDATES'			=> 'Verfügbare Updates',

	// ext manager
	'EXTMGRPLUS_ALL_DISABLE'				=> 'Ausgewählte deaktivieren',
	'EXTMGRPLUS_ALL_ENABLE'					=> 'Ausgewählte aktivieren',
	'EXTMGRPLUS_EXTENSIONS_ENABLED'			=> 'Aktivierte Erweiterungen: %u',
	'EXTMGRPLUS_EXTENSIONS_DISABLED'		=> 'Deaktivierte Erweiterungen: %u',
	'EXTMGRPLUS_EXTENSIONS_NOT_INSTALLED'	=> 'Nicht installierte Erweiterungen: %u',

	// tooltips
	'EXTMGRPLUS_TOOLTIP_HAS_MIGRATION'		=> 'Diese Erweiterung hat neue Migrationen, die beim aktivieren der Erweiterung übernommen werden.',
	'EXTMGRPLUS_TOOLTIP_IS_IGNORED'			=> 'Diese Erweiterung wird von „Extension Manager Plus“ ignoriert.',
	'EXTMGRPLUS_TOOLTIP_BUTTON_DISABLE'		=> 'Alle ausgewählten Erweiterungen deaktivieren.',
	'EXTMGRPLUS_TOOLTIP_BUTTON_ENABLE'		=> 'Alle ausgewählten Erweiterungen aktivieren.',
	'EXTMGRPLUS_TOOLTIP_ORDER'				=> 'Reihenfolge-Gruppe im Bereich 0-99.',
	'EXTMGRPLUS_TOOLTIP_IGNORE'				=> 'Erweiterung ignorieren.',
	'EXTMGRPLUS_TOOLTIP_SELECT_ALL'			=> 'Alle Erweiterungen auswählen oder abwählen.',
	'EXTMGRPLUS_TOOLTIP_SELECT'				=> 'Erweiterung auswählen.',

	// columns
	'EXTMGRPLUS_COL_MIGRATIONS'				=> 'Neue Migrationen',
	'EXTMGRPLUS_COL_SELECT'					=> 'Auswählen',
	'EXTMGRPLUS_COL_ORDER'					=> 'Reihenfolge',
	'EXTMGRPLUS_COL_IGNORE'					=> 'Ignorieren',

	// link bar
	'EXTMGRPLUS_LINK_ORDER_AND_IGNORE'		=> 'Reihenfolge & Ignorieren',
	'EXTMGRPLUS_LINK_SAVE_CHECKBOXES'		=> 'Speichern',

	// misc
	'EXTMGRPLUS_EXTENSION_PLURAL' => [
		0									=> '0 Erweiterungen',
		1									=> '1 Erweiterung',
		2									=> '%u Erweiterungen',
	],

	// messages
	'EXTMGRPLUS_MSG_CONFIRM_DISABLE'		=> 'Bist du dir sicher, dass du %s deaktivieren möchtest?',
	'EXTMGRPLUS_MSG_CONFIRM_ENABLE'			=> 'Bist du dir sicher, dass du %s aktivieren möchtest?',
	'EXTMGRPLUS_MSG_ORDER_AND_IGNORE_SAVED'	=> 'Spalten für Reihenfolge und Ignorieren erfolgreich gespeichert.',
	'EXTMGRPLUS_MSG_CHECKBOXES_SAVED'		=> 'Auswahl der Kontrollkästchen erfolgreich gespeichert.',
	'EXTMGRPLUS_MSG_PROCESS_ABORTED'		=> 'Der Vorgang „%s“ wurde von folgender Erweiterung unterbrochen:',
	'EXTMGRPLUS_MSG_DEACTIVATION'			=> 'Es wurden %1$u von %2$u Erweiterungen deaktiviert.',
	'EXTMGRPLUS_MSG_ACTIVATION'				=> 'Es wurden %1$u von %2$u Erweiterungen aktiviert.',
	'EXTMGRPLUS_MSG_ACTIVATION_FAILED'		=> 'Die folgenden Erweiterungen konnten nicht aktiviert werden:',
	'EXTMGRPLUS_MSG_SAFE_TIME_EXCEEDED'		=> 'Der Toleranzbereich (%u Sekunden) der maximalen PHP Ausführungszeit wurde überschritten.',
	'EXTMGRPLUS_MSG_SELF_DISABLE'			=> 'Hinweis: Die Erweiterung „Extension Manager Plus“ wird ebenfalls deaktiviert.',
]);
