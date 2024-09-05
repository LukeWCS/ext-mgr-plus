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
	'EXTMGRPLUS_COL_AVAILABLE_EXTENSIONS'	=> 'Verfügbare Erweiterungen',
	'EXTMGRPLUS_COL_WITH_VERSIONCHECK'		=> 'Mit Versionsprüfung',
	'EXTMGRPLUS_COL_LAST_VERSIONCHECK'		=> 'Letzte Versionsprüfung',
	'EXTMGRPLUS_COL_AVAILABLE_UPDATES'		=> 'Verfügbare Updates',
	'EXTMGRPLUS_AVAILABLE_EXTENSIONS' => [
		0									=> '%2$u',
		1									=> '%2$u (%1$u ungültige)',
	],
	'EXTMGRPLUS_VERSIONCHECK_DATE' => [
		0									=> '%2$s',
		1									=> '%2$s (%1$u Fehler)',
	],

	// link bar
	'EXTMGRPLUS_LINK_ORDER_AND_IGNORE'		=> 'Reihenfolge & Ignorieren',
	'EXTMGRPLUS_LINK_SAVE_CHECKBOXES'		=> 'Speichern',

	// settings order and ignore
	'EXTMGRPLUS_SECTION_SETTINGS'			=> 'Einstellungen (Plus)',
	'EXTMGRPLUS_ORDER'						=> 'Reihenfolge',
	'EXTMGRPLUS_ORDER_EXPLAIN'				=> '%s In dieser Spalte können Sie Reihenfolge-Gruppen im Bereich 0 bis 99 für die Aktion „Ausgewählte aktivieren“ definieren. Damit können Erweiterungen, von denen andere Erweiterungen abhängig sind, vor diesen aktiviert werden, um Fehlermeldungen zu vermeiden. Erweiterungen die zu einer solchen Gruppe gehören, werden zuerst aktiviert und zwar beginnend bei Gruppe 0, dann Gruppe 1 und so weiter. Erweiterungen ohne Gruppe werden als letztes aktiviert.',
	'EXTMGRPLUS_DEPENDENCY_EXPLAIN'			=> 'Mit einem vorangestelltem <code>+</code> kann eine Erweiterung mit einer Gruppe verknüpft werden. Hat man zum Beispiel die Erweiterung B die von Erweiterung A abhängig ist, kann man bei A <code>0</code> eintragen und bei B <code>+0</code>. Sind beide Erweiterungen aktiviert, wird beim Auswählen von A auch B ausgewählt. Sind beide Erweiterungen deaktiviert, wird beim Auswählen von B auch A ausgewählt.',
	'EXTMGRPLUS_IGNORE'						=> 'Ignorieren',
	'EXTMGRPLUS_IGNORE_EXPLAIN'				=> '%s In dieser Spalte können Sie festlegen, welche Erweiterungen bei den Aktionen „Ausgewählte aktivieren“ und „Ausgewählte deaktivieren“ ignoriert werden sollen. Ignorierte Erweiterungen können in der Erweiterungen-Liste nicht mehr ausgewählt werden. Wenn bei einer ignorierten Erweiterung eine Reihenfolge-Gruppe definiert wurde, dann bleibt diese erhalten, sie hat jedoch keine Bedeutung mehr.',

	// ext manager
	'EXTMGRPLUS_COL_MIGRATIONS'				=> 'Neue Migrationen',
	'EXTMGRPLUS_COL_SELECT'					=> 'Auswählen',
	'EXTMGRPLUS_COL_ORDER'					=> 'Reihenfolge',
	'EXTMGRPLUS_COL_IGNORE'					=> 'Ignorieren',
	'EXTMGRPLUS_ALL_DISABLE'				=> 'Ausgewählte deaktivieren',
	'EXTMGRPLUS_ALL_ENABLE'					=> 'Ausgewählte aktivieren',
	'EXTMGRPLUS_EXTENSIONS_ENABLED'			=> 'Aktivierte Erweiterungen: %u',
	'EXTMGRPLUS_EXTENSIONS_DISABLED'		=> 'Deaktivierte Erweiterungen: %u',
	'EXTMGRPLUS_EXTENSIONS_NOT_INSTALLED'	=> 'Nicht installierte Erweiterungen: %u',

	// tooltips
	'EXTMGRPLUS_TOOLTIP_HAS_MIGRATION'		=> 'Diese Erweiterung hat neue Migrationen, die beim aktivieren der Erweiterung übernommen werden.',
	'EXTMGRPLUS_TOOLTIP_OUTDATED'			=> 'Die installierte Version dieser Erweiterung ist veraltet.',
	'EXTMGRPLUS_TOOLTIP_VERSIONCHECK_ERROR'	=> 'Bei der Versionsprüfung ist ein Fehler aufgetreten. Klicken Sie auf „Details“ um mehr zu erfahren.',
	'EXTMGRPLUS_TOOLTIP_NO_VERSIONCHECK'	=> 'Diese Erweiterung bietet keine Versionsprüfung.',
	'EXTMGRPLUS_TOOLTIP_IS_IGNORED'			=> 'Diese Erweiterung wird von „Extension Manager Plus“ ignoriert.',
	'EXTMGRPLUS_TOOLTIP_IS_LOCKED'			=> 'Die Auswahl dieser Erweiterung ist wegen neuer Migrationen gesperrt.',
	'EXTMGRPLUS_TOOLTIP_BUTTON_DISABLE'		=> 'Alle ausgewählten Erweiterungen deaktivieren.',
	'EXTMGRPLUS_TOOLTIP_BUTTON_ENABLE'		=> 'Alle ausgewählten Erweiterungen aktivieren.',
	'EXTMGRPLUS_TOOLTIP_ORDER'				=> 'Reihenfolge-Gruppe im Bereich 0-99. Mit vorangestelltem + kann eine Gruppe verknüpft werden.',
	'EXTMGRPLUS_TOOLTIP_IGNORE'				=> 'Erweiterung ignorieren.',
	'EXTMGRPLUS_TOOLTIP_SELECT_ALL'			=> 'Alle Erweiterungen auswählen oder abwählen.',
	'EXTMGRPLUS_TOOLTIP_SELECT'				=> 'Erweiterung auswählen.',

	// misc
	'EXTMGRPLUS_EXTENSION_PLURAL' => [
		0									=> '0 Erweiterungen',
		1									=> '1 Erweiterung',
		2									=> '%u Erweiterungen',
	],
	'EXTMGRPLUS_VERSIONCHECK_PROGRESS'		=> '%1$u / %2$u',

	// messages
	'EXTMGRPLUS_MSG_CONFIRM_DISABLE'		=> 'Sind Sie sich sicher, dass Sie %s deaktivieren möchten?',
	'EXTMGRPLUS_MSG_CONFIRM_ENABLE'			=> 'Sind Sie sich sicher, dass Sie %s aktivieren möchten?',
	'EXTMGRPLUS_MSG_ORDER_AND_IGNORE_SAVED'	=> 'Spalten für Reihenfolge und Ignorieren erfolgreich gespeichert.',
	'EXTMGRPLUS_MSG_CHECKBOXES_SAVED'		=> 'Auswahl der Kontrollkästchen erfolgreich gespeichert.',
	'EXTMGRPLUS_MSG_PROCESS_ABORTED'		=> 'Der Vorgang „%s“ wurde von folgender Erweiterung unterbrochen:',
	'EXTMGRPLUS_MSG_DEACTIVATION'			=> 'Es wurden %1$u von %2$u Erweiterungen deaktiviert.',
	'EXTMGRPLUS_MSG_ACTIVATION'				=> 'Es wurden %1$u von %2$u Erweiterungen aktiviert.',
	'EXTMGRPLUS_MSG_ACTIVATION_FAILED'		=> 'Die folgenden Erweiterungen konnten nicht aktiviert werden:',
	'EXTMGRPLUS_MSG_SAFE_TIME_EXCEEDED'		=> 'Der Toleranzbereich (%u Sekunden) der maximalen PHP Ausführungszeit wurde überschritten.',
	'EXTMGRPLUS_MSG_SELF_DISABLE'			=> 'Hinweis: Die Erweiterung „Extension Manager Plus“ wird ebenfalls deaktiviert.',
	'EXTMGRPLUS_MSG_VERSIONCHECK_HINT'		=> 'Die Erweiterungen werden auf neue Versionen geprüft, bitte warten. %s',
]);
