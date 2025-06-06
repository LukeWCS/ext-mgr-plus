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
	'EXTMGRPLUS_SECTION_SETTINGS'			=> 'Einstellungen (Plus)',
	'EXTMGRPLUS_LOG'						=> 'Log-Eintrag',
	'EXTMGRPLUS_LOG_EXPLAIN'				=> 'Hier kannst du festlegen, ob bei den Aktionen „Ausgewählte aktivieren“ und „Ausgewählte deaktivieren“ ein Eintrag im Administrator-Log hinzugefügt werden soll.',
	'EXTMGRPLUS_CONFIRMATION'				=> 'Rückfrage',
	'EXTMGRPLUS_CONFIRMATION_EXPLAIN'		=> 'Hier kannst du festlegen, ob bei den Aktionen „Ausgewählte aktivieren“ und „Ausgewählte deaktivieren“ eine Rückfrage erfolgen soll, die bestätigt werden muss.',
	'EXTMGRPLUS_AUTO_REDIRECT'				=> 'Meldungen automatisch bestätigen',
	'EXTMGRPLUS_AUTO_REDIRECT_EXPLAIN'		=> 'Hier kannst du festlegen, ob positive Meldungen automatisch bestätigt werden sollen. Fehlermeldungen müssen weiterhin manuell bestätigt werden.',
	'EXTMGRPLUS_CHECKBOX_MODE'				=> 'Kontrollkästchen setzen',
	'EXTMGRPLUS_CHECKBOX_MODE_EXPLAIN'		=> 'Bei der Auswahl „Alle setzen“ werden automatisch alle Kontrollkästchen gesetzt. Bei der Auswahl „Letzten Zustand merken“ wird der Zustand aller Kontrollkästchen gespeichert, wenn die Aktion „Ausgewählte aktivieren“ oder „Ausgewählte deaktivieren“ ausgeführt wird. Zusätzlich kann der Zustand aller Kontrollkästchen auch über den Link „%s Speichern“ gespeichert werden.',
	'EXTMGRPLUS_CHECKBOX_MODE_OFF'			=> 'Aus',
	'EXTMGRPLUS_CHECKBOX_MODE_ALL'			=> 'Alle setzen',
	'EXTMGRPLUS_CHECKBOX_MODE_LAST'			=> 'Letzten Zustand merken',
	'EXTMGRPLUS_SELF_DISABLE'				=> 'Erlaube Eigendeaktivierung',
	'EXTMGRPLUS_SELF_DISABLE_EXPLAIN'		=> 'Wenn du diese Option aktivierst, dann kann sich „Extension Manager Plus“ bei der Aktion „Ausgewählte deaktivieren“ auch selbst deaktivieren, da diese Erweiterung dann wie jede andere ausgewählt werden kann.',
	'EXTMGRPLUS_INSTRUCTIONS'				=> 'Anleitungen anzeigen',
	'EXTMGRPLUS_INSTRUCTIONS_EXPLAIN'		=> 'Mit dieser Option kannst du festlegen, ob die Anleitungen für Installieren, Aktualisieren und Deinstallieren am Ende der Erweiterungen-Liste angezeigt werden sollen.',
	'EXTMGRPLUS_VC_LIMIT'					=> 'Ausführungszeit der Versionsprüfung aufteilen',
	'EXTMGRPLUS_VC_LIMIT_EXPLAIN'			=> 'Die Versionsprüfung wird blockweise ausgeführt und mit diesem Wert kannst du festlegen, wie lange ein einzelner Block der Versionsprüfung maximal dauern darf. Damit wird verhindert, dass Zeitlimits von PHP oder der Datenbank überschritten werden.',

	// settings extension properties
	'EXTMGRPLUS_SECTION_EXT_PROPERTIES'		=> 'Eigenschaften der Erweiterungen',
	'EXTMGRPLUS_ORDER_AND_IGNORE'			=> 'Reihenfolge, Abhängigkeit und Ignorieren',
	'EXTMGRPLUS_ORDER_AND_IGNORE_EXPLAIN'	=> 'Wenn du diese Option aktivierst, wird bei den Aktionen „Ausgewählte aktivieren“ und „Ausgewählte deaktivieren“ die Reihenfolge-Gruppe und das Ignorieren-Merkmal berücksichtigt. Außerdem werden beim Auswählen/Abwählen auch definierte Abhängigkeiten berücksichtigt.',

	// settings expert
	'EXTMGRPLUS_SECTION_EXPERT_SETTINGS'	=> 'Experten-Einstellungen',
	'EXTMGRPLUS_EXPERT_SETTINGS_EXPLAIN'	=> 'In diesem Abschnitt können besondere Funktionen aktiviert werden, die zum Beispiel für Entwickler relevant sind. Bei Funktionen die problematisch sein können, muss eine Rückfrage bestätigt werden.',
	'EXTMGRPLUS_MIGRATION_COL'				=> 'Spalte mit neuen Migrationen anzeigen',
	'EXTMGRPLUS_MIGRATION_COL_EXPLAIN'		=> 'Wenn diese Option aktiviert ist, dann wird eine zusätzliche Spalte angezeigt, in der die Anzahl neuer Migrationen aufgeführt ist. Die Anzahl wird sowohl bei „Deaktivierte Erweiterungen“ als auch bei „Nicht installierte Erweiterungen“ angezeigt.',
	'EXTMGRPLUS_MIGRATIONS'					=> 'Erlaube Erweiterungen mit neuen Migrationen',
	'EXTMGRPLUS_MIGRATIONS_EXPLAIN'			=> 'Wenn diese Option aktiviert ist, dann kannst du bei der Aktion „Ausgewählte aktivieren“ auch diejenigen Erweiterungen auswählen, bei denen neue Migrationen vorliegen. Das trifft auf aktualisierte Erweiterungen zu, die einen Ordner <code>migrations</code> enthalten. Ohne diese Option müssen solche Erweiterungen manuell aktiviert werden, was empfohlen wird.',
	'EXTMGRPLUS_VERSION_URL'				=> 'Link zur Versionsdatei anzeigen',
	'EXTMGRPLUS_VERSION_URL_EXPLAIN'		=> 'Wenn du diese Option aktivierst, kannst du dir auf der Seite „Details“ einer Erweiterung den Link zur Versionsdatei anzeigen lassen, die von phpBB bei einer Versionsprüfung vom jeweiligen Server geladen und ausgewertet wird.',

	// settings reset
	'EXTMGRPLUS_SECTION_RESET'				=> 'Zurücksetzen',
	'EXTMGRPLUS_DEFAULTS'					=> 'Einstellungen zurücksetzen',
	'EXTMGRPLUS_DEFAULTS_EXP'				=> 'Setzt alle Einstellungen auf den Installationsstandard zurück. (Hat keine Auswirkung auf die Spalten von „Eigenschaften der Erweiterungen“.)',
	'EXTMGRPLUS_BUTTON_DEFAULTS'			=> 'Standard',

	// messages
	'EXTMGRPLUS_MSG_CONFIRM_MIGRATIONS'		=> 'Bist du dir sicher, dass du die Aktivierung von Erweiterungen mit neuen Migrationen erlauben möchtest?',
	'EXTMGRPLUS_MSG_SETTINGS_SAVED'			=> 'Einstellungen erfolgreich gespeichert.',
]);
