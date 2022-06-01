### 1.0.0

#### 1.0.0-b6
* ExtMgr Template:
  * Es gibt jetzt ein neuen Schalter mit dem man festlegen kann, ob die Checkboxen standardmässig alle gesetzt sind oder nicht. [Vorschlag von Kirk]
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
