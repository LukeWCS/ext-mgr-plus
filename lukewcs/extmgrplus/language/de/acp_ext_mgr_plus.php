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
	'EXTMGRPLUS_AVAILABLE_EXTENSIONS'		=> [
		0									=> '%2$u',
		1									=> '%2$u (%1$u ungültige)',
	],
	'EXTMGRPLUS_VERSIONCHECK_DATE'			=> [
		0									=> '%2$s (%3$u Sek.)',
		1									=> '%2$s (%3$u Sek. / %1$u Fehler)',
	],

	// link bar
	'EXTMGRPLUS_LINK_EXT_PROPERTIES'		=> 'Eigenschaften der Erweiterungen',
	'EXTMGRPLUS_LINK_SAVE_CHECKBOXES'		=> 'Speichern',

	// settings order and ignore
	'EXTMGRPLUS_SECTION_SETTINGS'			=> 'Einstellungen (Plus)',
	'EXTMGRPLUS_ORDER'						=> '%s Reihenfolge & Abhängigkeit',
	'EXTMGRPLUS_ORDER_EXPLAIN'				=> 'In dieser Spalte kannst du Reihenfolge-Gruppen im Bereich 0 bis 99 für die Aktionen „Ausgewählte aktivieren“ und „Ausgewählte deaktivieren“ definieren. Damit können Erweiterungen, von denen andere Erweiterungen abhängig sind, vor diesen aktiviert werden, um Fehlermeldungen zu vermeiden. Erweiterungen die zu einer solchen Gruppe gehören, werden zuerst aktiviert und zwar beginnend bei Gruppe 0, dann Gruppe 1 und so weiter. Erweiterungen ohne Gruppe werden als letztes aktiviert. Beim Deaktivieren ist die Reihenfolge umgekehrt.',
	'EXTMGRPLUS_DEPENDENCY'					=> 'Abhängigkeit',
	'EXTMGRPLUS_DEPENDENCY_EXPLAIN'			=> 'Mit einem vorangestelltem <code>+</code> kann eine Erweiterung mit einer Gruppe verknüpft werden. Hat man zum Beispiel die Erweiterung B die von Erweiterung A abhängig ist, kann man bei A <code>0</code> eintragen und bei B <code>+0</code>. Sind beide Erweiterungen aktiviert, wird beim Auswählen von A auch B ausgewählt. Sind beide Erweiterungen deaktiviert, wird beim Auswählen von B auch A ausgewählt.',
	'EXTMGRPLUS_IGNORE'						=> '%s Ignorieren',
	'EXTMGRPLUS_IGNORE_EXPLAIN'				=> 'In dieser Spalte kannst du festlegen, welche Erweiterungen bei den Aktionen „Ausgewählte aktivieren“ und „Ausgewählte deaktivieren“ ignoriert werden sollen. Ignorierte Erweiterungen können in der Erweiterungen-Liste nicht mehr ausgewählt werden und bei solchen Erweiterungen werden auch keine neuen Migrationen ermittelt und angezeigt. Wenn bei einer ignorierten Erweiterung eine Reihenfolge-Gruppe definiert wurde, dann bleibt diese erhalten, sie hat jedoch keine Bedeutung mehr.',

	// ext manager
	'EXTMGRPLUS_COL_CDB'					=> 'Validierte Erweiterung',
	'EXTMGRPLUS_COL_MIGRATIONS'				=> 'Neue Migrationen',
	'EXTMGRPLUS_COL_SELECT'					=> 'Auswählen',
	'EXTMGRPLUS_COL_ORDER'					=> 'Reihenfolge',
	'EXTMGRPLUS_COL_IGNORE'					=> 'Ignorieren',
	'EXTMGRPLUS_DISABLE_ALL'				=> 'Ausgewählte deaktivieren',
	'EXTMGRPLUS_ENABLE_ALL'					=> 'Ausgewählte aktivieren',
	'EXTMGRPLUS_EXTENSIONS_ENABLED'			=> 'Aktivierte Erweiterungen: %u',
	'EXTMGRPLUS_EXTENSIONS_DISABLED'		=> 'Deaktivierte Erweiterungen: %u',
	'EXTMGRPLUS_EXTENSIONS_NOT_INSTALLED'	=> 'Nicht installierte Erweiterungen: %u',

	// tooltips
	'EXTMGRPLUS_TOOLTIP_HAS_MIGRATION'		=> 'Diese Erweiterung hat neue Migrationen, die beim aktivieren der Erweiterung übernommen werden.',
	'EXTMGRPLUS_TOOLTIP_DISABLE_ALL'		=> 'Alle ausgewählten Erweiterungen deaktivieren.',
	'EXTMGRPLUS_TOOLTIP_ENABLE_ALL'			=> 'Alle ausgewählten Erweiterungen aktivieren.',
	'EXTMGRPLUS_TOOLTIP_ORDER'				=> 'Reihenfolge-Gruppe im Bereich 0-99. Mit vorangestelltem + kann eine Gruppe verknüpft werden.',
	'EXTMGRPLUS_TOOLTIP_IGNORE'				=> 'Erweiterung ignorieren.',
	'EXTMGRPLUS_TOOLTIP_SELECT_ALL'			=> 'Alle Erweiterungen auswählen oder abwählen.',
	'EXTMGRPLUS_TOOLTIP_SELECT'				=> 'Erweiterung auswählen.',
	'EXTMGRPLUS_TOOLTIP_IS_LOCKED'			=> 'Die Auswahl dieser Erweiterung ist wegen neuer Migrationen gesperrt.',
	// tooltips icons
	'EXTMGRPLUS_TOOLTIP_CDB_EXT'			=> 'Das ist eine validierte Erweiterung.',
	'EXTMGRPLUS_TOOLTIP_CDB_EXT_OFFICIAL'	=> 'Das ist eine offizielle Erweiterung von phpBB.com.',
	'EXTMGRPLUS_TOOLTIP_OUTDATED'			=> 'Die installierte Version dieser Erweiterung ist veraltet.',
	'EXTMGRPLUS_TOOLTIP_VERSIONCHECK_ERROR'	=> 'Bei der Versionsprüfung ist ein Fehler aufgetreten. Klicke auf „Details“ um mehr zu erfahren.',
	'EXTMGRPLUS_TOOLTIP_VERSIONCHECK_EMPTY'	=> 'Bei dieser Erweiterung wurde keine Versionsprüfung ausgeführt.',
	'EXTMGRPLUS_TOOLTIP_NO_VERSIONCHECK'	=> 'Diese Erweiterung bietet keine Versionsprüfung.',
	'EXTMGRPLUS_TOOLTIP_IS_IGNORED'			=> 'Diese Erweiterung wird von „Extension Manager Plus“ ignoriert.',
	'EXTMGRPLUS_TOOLTIP_SETTINGS'			=> 'Das primäre Einstellungsmodul dieser Erweiterung aufrufen.',

	// misc
	'EXTMGRPLUS_EXTENSION_PLURAL'			=> [
		0									=> '0 Erweiterungen',
		1									=> '1 Erweiterung',
		2									=> '%u Erweiterungen',
	],
	'EXTMGRPLUS_SECOND_PLURAL'				=> [
		0									=> '0 Sekunden',
		1									=> '1 Sekunde',
		2									=> '%u Sekunden',
	],
	'EXTMGRPLUS_SPOILER_LABEL'				=> 'Erklärung',

	// details
	'EXTMGRPLUS_DETAILS_CDB_PAGE'			=> 'Seite der phpBB-Erweiterungsdatenbank',
	'EXTMGRPLUS_DETAILS_VERSION_URL'		=> 'Link zur Versionsdatei',

	// messages
	'EXTMGRPLUS_MSG_CONFIRM_DISABLE'		=> 'Bist du dir sicher, dass du %s deaktivieren möchtest?',
	'EXTMGRPLUS_MSG_CONFIRM_ENABLE'			=> 'Bist du dir sicher, dass du %s aktivieren möchtest?',
	'EXTMGRPLUS_MSG_EXT_PROPERTIES_SAVED'	=> 'Eigenschaften der Erweiterungen erfolgreich gespeichert.',
	'EXTMGRPLUS_MSG_CHECKBOXES_SAVED'		=> 'Auswahl der Kontrollkästchen erfolgreich gespeichert.',
	'EXTMGRPLUS_MSG_PROCESS_ABORTED'		=> 'Der Vorgang „%s“ wurde von folgender Erweiterung unterbrochen:',
	'EXTMGRPLUS_MSG_DEACTIVATION'			=> 'Es wurden %1$u von %2$u Erweiterungen deaktiviert.',
	'EXTMGRPLUS_MSG_ACTIVATION'				=> 'Es wurden %1$u von %2$u Erweiterungen aktiviert.',
	'EXTMGRPLUS_MSG_DEACTIVATION_FAILED'	=> 'Die folgenden Erweiterungen konnten nicht deaktiviert werden:',
	'EXTMGRPLUS_MSG_ACTIVATION_FAILED'		=> 'Die folgenden Erweiterungen konnten nicht aktiviert werden:',
	'EXTMGRPLUS_MSG_SAFE_TIME_EXCEEDED'		=> 'Der Toleranzbereich (%u Sekunden) der maximalen PHP Ausführungszeit wurde überschritten.',
	'EXTMGRPLUS_MSG_SELF_DISABLE'			=> 'Hinweis: Die Erweiterung „Extension Manager Plus“ wird ebenfalls deaktiviert.',
	// messages versioncheck
	'EXTMGRPLUS_MSG_VERSIONCHECK_HINT'		=> 'Die Erweiterungen werden auf neue Versionen geprüft.',
	'EXTMGRPLUS_MSG_VERSIONCHECK_BLOCK'		=> 'Aktueller Block (maximal %s)',
	'EXTMGRPLUS_MSG_VERSIONCHECK_PROGRESS'	=> 'Erweiterungen geprüft: %1$u / %2$u',
]);
