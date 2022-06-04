### 1.0.0

#### 1.0.0-b9
* Fix: In der Responsive-Ansicht wurde das Textfeld für Reihenfolge/Ignorieren auch dann angezeigt, wenn die Einstellungen nicht geöffnet waren. Um weitere Kopfschmerzen wegen dem phpBB Responsive CSS zu vermeiden, wird die Spalte jetzt wieder per Inline-CSS ausgeblendet, da das wenigstens unkompliziert funktioniert.
* Fix: In der Responsive-Ansicht wurde die Zeile mit dem Textfeld für Reihenfolge/Ignorieren nicht korrekt dargestellt, wenn die Einstellungen geöffnet waren.
* JS Funktion zum Anzeigen/Ausblenden der Einstellungen komplett geändert.

#### 1.0.0-b8
* Fix: In der Spalte für Reihenfolge/Ignorieren konnten keine 2-stelligen Werte eingetragen werden. Im HTML wurde schlicht das RegEx für die Eingabeprüfung falsch definiert. [Meldung von Kirk]
* In der Responsive-Ansicht werden nun auch bei den neuen EMP Spalten (neue Migrationsdateien, Auswählen, Reihenfolge/Ignorieren) einleitende Spaltenüberschriften angezeigt, wie das phpBB auch bei den Standard-Spalten macht. Bislang wurden gar keine Texte angezeigt, da die Spalten in der normalen Ansicht nur FA Icons enthalten.
* ExtMgr Template:
  * Wenn die Einstellungen geöffnet werden, dann werden jetzt in der Erweiterungen-Liste auch alle Links für "Aktivieren", "Deaktivieren" und "Arbeitsdaten löschen" ausgeblendet. Somit gibt es bei geöffneten Einstellungen nur noch die Textfelder als aktive Elemente in der Erweiterungen-Liste.
  * Sämtliches Inline-CSS entfernt. Damit enthält das HTML keinerlei Style-Definitionen mehr.
  * Weiteres XHTML entdeckt und entfernt.
  * Twig: Unnötige `{% if ... %}...{% endif %}` Konstrukte durch Ternarys ersetzt.
* Code Optimierungen.
* Sprachdateien:
  * Neue Sprachvariablen für die Responsive-Ansicht.
  * Kleinere Änderungen
* CSS:
  * CSS für die Responsive-Ansicht hinzugefügt.
  * Bisheriges Inline-CSS zur CSS Datei hinzugefügt.
  * Optimierungen.

#### 1.0.0-b7
* Erweiterungen können jetzt in einer definierten Reihenfolge aktiviert werden, indem diesen eine numerische Gruppe im Bereich 0-99 zugewiesen wird. Erweiterungen mit einer Reihenfolge-Gruppe werden immer vor Erweiterungen aktiviert, die keine Gruppe haben.
* Erweiterungen können jetzt auch komplett ignoriert werden, indem statt der numerischen Gruppe einfach ein `-` zugewiesen wird.
* Die Funktionen die in b3 hinzugefügt wurden bezüglich Verwaltung beliebig vieler Variablen in einer einzigen `config_text` Variable universell gestaltet, damit diese Funktion auch zum speichern der Reihenfolge Spalte genutzt werden kann.
* ExtMgr Template:
  * Es gibt jetzt eine neue Spalte mit 2-stelligen Textfeldern in der Liste der Erweiterungen, die nur dann angezeigt wird, wenn die Einstellungen geöffnet sind. Die Felder haben einen Tooltip der erklärt, welcher Inhalt erwartet wird. Die Felder werden beim speichern ausserdem auf gültigen Inhalt geprüft.
  * Es gibt eine neue Sektion in den Einstellungen mit Erklärungen zur Reihenfolge und Ignorieren Funktion sowie einen Button zum speichern der Spalte.
  * HTML so geändert, dass die Buttons und Checkboxen ausgeblendet werden können.
  * Javascript so geändert, dass entweder die Buttons und die Checkboxen-Spalte, oder die Reihenfolge-Spalte angezeigt wird.
  * Neues Twig Makro für die Textfelder.
* Sprachdateien:
  * Neue Sprachvariablen für die Reihenfolge und Ignorieren Funktionen.
* CSS:
  * CSS für die Reihenfolge und Ignorieren Funktionen hinzugefügt.

#### 1.0.0-b6
* ExtMgr Template:
  * Es gibt jetzt einen neuen Schalter mit dem man festlegen kann, ob die Checkboxen standardmässig alle gesetzt sind oder nicht. [Vorschlag von Kirk]
  * Etliche Anpassungen für die Checkbox Option.
* Statt zwei Einstellungen-Links gibt es nur noch einen. Mit diesem Link werden also gleichzeitig beide Formulare von phpBB und ExtMgrPlus angezeigt oder ausgeblendet. [Vorschlag von Scanialady]
  * JS Hilfsfunktion dafür eingebaut, mit der mehrere Elemente gleichzeitig ein/ausgeblendet werden können.
* Sprachdateien:
  * Neue Sprachvariablen für die Checkbox Option.

#### 1.0.0-b5
* Fix: Bei der Umbenennung der JS Datei für die Checkboxen hat das Suffix gefehlt. Dadurch wurde in den Entwicklertools von FF eine Warnung bezüglich "ungültiger MIME Typ" ausgegeben.
* ExtMgr Template:
  * Wenn es in einer Sektion keine schaltbaren Exts gibt, dann wird jetzt auch die zugehörige Alle-Checkbox deaktiviert.
  * Bei deaktivierten Elementen werden jetzt unnötige Attribute wie `name=`, `value=` und `onchange=` gar nicht erst hinzugefügt.
  * Die Anzahl der verfügbaren Erweiterungen und die Link-Leiste in eine Blind-Tabelle gepackt und Flow entfernt. Dadurch passt sich dieser Abschnitt bei Responsive automatisch an.
  * Restliches XHTML entfernt.
* CSS:
  * `cursor: not-allowed` auch bei deaktivierten Checkboxen hinzugefügt.
  * CSS für die Blind-Tabelle hinzugefügt.
* Code Optimierung.
  
#### 1.0.0-b4
* Fix: Die neue Methode für die ToDo Variablen hatte noch 2 kleinere Fehler, weshalb es je nach Aktion zu Array Index Fehlern kam.

#### 1.0.0-b3
* ErrorBox Handhabung bei Abbruch der Aktivierung:
  * Methode komplett geändert. Um auf das HTML Event verzichten zu können, eine eigene Funktion eingebaut, mit der eine ErrorBox Meldung abgefangen und manipuliert werden kann. Damit ist die Handhabung des Aktivierungsabbruchs kein Workaround mehr, sondern eine ordentliche Lösung.
  * HTML Event `acp_overall_header_body_before.html` entfernt.
  * Javascript `ext_mgr_errorbox.js` entfernt.
* Durch die neue Methode der ErrorBox Handhabung, wurde es nun möglich, die Eigendeaktivierung als Option einzubauen. [Vorschlag von 69bruno]
* ExtMgr Template:
  * Security Token auch beim Listen-Formular (Buttons und Checkboxen) und beim Rückfrage-Formular hinzugefügt. Damit ist jetzt jede Aktion von EMP mit Token gesichert.
  * Neuer Schalter für die Eigendeaktivierung.
  * Im Listengenerator die neue Eigendeaktivierung berücksichtigt.
* Neue Methode eingebaut um ToDo Variablen einfacher verwalten zu können. Dadurch müssen für temporäre Variablen keine DB Config Variablen mehr angelegt werden. Ausserdem können jederzeit beliebig viele Variablen hinzugefügt werden, ohne dass die Migration geändert werden müsste.
  * Funktion eingebaut, mit der eine beliebige Anzahl von Variablen und Arrays zu einem einzigen `config_text` Feld in der DB hinzugefügt werden kann. Mit dieser Funktion kann auch eine einzelne Variable oder alle gelöscht werden.
  * Funktion eingebaut mit der eine Variable oder Array aus dem `config_text` Feld der DB gelesen werden kann.
* Die DB Config Variablen `extmgrplus_exec_todo` und `extmgrplus_todo_purge_cache` entfernt, die nun keine Relevanz mehr haben.
* Sprachdateien:
  * Neue Sprachvariablen für die Eigendeaktivierung.
  * Kleinere Änderungen
* Code Optimierung.
* Debugs aus PHP und JS entfernt.

#### 1.0.0-b2
* ExtMgr Template:
  * Die Anzahl der neuen Migrationsdateien wird jetzt nicht mehr in der Spalte der Ext Namen angezeigt, sondern in einer neuen Spalte.
  * HTML besser strukturiert.
  * Einrückungen korrigiert.
  * Ein Twig Makro entfernt und Variablen direkt eingebaut.
* CSS:
  * Bereinigt und überflüssiges entfernt.
* Kleinere Änderungen in den Sprachdateien
* Alle Fehler vom EC Bericht behoben.

#### 1.0.0-b1
* Initial Release.
* Erste interne Testversion.
