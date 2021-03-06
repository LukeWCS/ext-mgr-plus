### 1.0.3

#### 1.0.3
* Release
* Core:
  * Code Optimierungen.

#### 1.0.3-b2
* ExtMgr Template:
  * Wird bei Ignorieren eine Checkbox gesetzt, wird das zugehörige Textfeld für Reihenfolge-Gruppe abgeblendet dargestellt.
  * Javascript dafür erweitert. Kleinere Fehler behoben.
* Core:
  * Code Optimierungen.

#### 1.0.3-b1
* Fix: War die Funktion Reihenfolge/Ignorieren deaktiviert, wurden auch deren gespeicherten Daten nicht mehr geladen und konnten somit nicht mehr geändert werden. Hat man dann die leere Spalte gespeichert, wurden die Daten effektiv gelöscht. Um das zu verhindern, bleibt die Beschriftung des Links zu Reihenfolge/Ignorieren zwar weiterhin abgeblendet sichtbar, wenn die Funktion deaktiviert ist, der Link wird jedoch entfernt und als Cursor erscheint das Gesperrt-Symbol.
* Reihenfolge/Ignorieren:
  * Reihenfolge-Gruppe und Ignorieren-Merkmal werden jetzt in separaten Spalten verwaltet.
  * Vorhandene Daten werden per Migration automatisch in das neue Array Format konvertiert.
* ExtMgr Template:
  * HTML und Javascript für die getrennte Verwaltung von Reihenfolge/Ignorieren erweitert.
  * In den Einstellungen haben die Erklärungen für Reihenfolge/Ignorieren jetzt das entsprechende Spalten-Icon als Präfix.
  * CSS angepasst.
* Sprachdateien:
  * Neue Sprachvariablen für die getrennte Verwaltung von Reihenfolge/Ignorieren.
  * Mehrere kleine Änderungen.
  
### 1.0.2

#### 1.0.2
* Release
* ExtMgr Template:
  * Tooltips für die Icons der Spaltenüberschriften und Checkboxen hinzugefügt.
  * Mehrere Änderungen in HTML und JS damit bestimmte Elemente flexibler angesprochen werden können.
* Core:
  * An die HTML Änderungen angepasst.
  * Code Optimierungen.
  * Formular Reihenfolge/Ignorieren wird jetzt ebenfalls auf Security Token geprüft.
* Sprachdateien:
  * Neue Sprachvariable für den Checkbox Tooltip.

#### 1.0.2-b1
* Bei der Prüfung ob eine Ext aktiviert werden kann mittels `is_enableable()` (`ext.php`), wird jetzt auch ein String und ein Array als möglicher Rückgabewert akzeptiert und entsprechend aufbereitet. Diese Methode der Fehlerbehandlung wurde erst in phpBB 3.3.0 eingeführt und kann `trigger_error` ersetzen. [Hinweis von IMC]

### 1.0.1

#### 1.0.1
* Release

#### 1.0.1-b2
* Die Fehlerbehandlung bei fehlgeschlagener Migration musste angepasst werden. Sobald ein Migrationsfehler ausgelöst und abgefangen wurde, war es nicht mehr möglich, eine `trigger_error` Meldung abzufangen. Darum wird jetzt bei einem Migrationsfehler sofort der Vorgang abgebrochen und direkt eine Fehlermeldung ausgegeben. Nur so ist gewährleistet, dass in jedem Fehler-Szenario vollständige Informationen ausgegeben werden können.
* Sprachdateien:
  * Die Erklärung der Option "Erlaube Migrationen" auf den Stand von 1.0.0-b9 zurückgesetzt.

#### 1.0.1-b1
* Fehlerbehandlung allgemein:
  * Sollten bei den Aktionen Aktivieren/Deaktivieren Fehler bei einzelnen Erweiterungen auftreten, wird jetzt in der Bestätigungsmeldung von EMP explizit auf solche Fehler hingewiesen, unter Angabe von Anzeigename, technischer Name und der jeweiligen Fehlermeldung. So erfährt man präzise welche Erweiterungen Probleme verursacht haben und den jeweiligen Grund dafür.
  * Die Bestätigungsmeldung von EMP wird nur noch dann als positiv eingestuft (grüne `successbox`), wenn ausnahmslos alle Erweiterungen geschaltet werden konnten. Bisher genügte dazu eine einzige, erfolgreich geschaltete Erweiterung. Wenn nur eine einzige Erweiterung nicht geschaltet werden konnte, wird das negativ eingestuft (rote `errorbox`).
  * Bei Meldungen von EMP ist jetzt immer erkennbar, welche Texte von EMP und welche von phpBB oder von einer Erweiterung stammen. Diejenigen Texte die nicht von EMP stammen, werden immer kursiv dargestellt.
* Neue Fehlerbehandlung bei fehlgeschlagenen Migrationen:
  * Ist die Option "Migrationen erlauben" aktiviert und es kommt während der Aktivierung einer Erweiterung mit neuen Migrationsdateien zu einem Fehler, dann führt das nicht länger zu einem "Fatal error" (quasi ein Absturz von phpBB). Stattdessen wird ein solcher Fehler abgefangen und nach Beendigung der Aktivierung eine kontrollierte Fehlermeldung dafür ausgegeben, mit der original Fehlermeldung von phpBB. Dadurch kann EMP problemlos mit der nächsten Erweiterung fortfahren und wird durch solche Migrationsfehler nicht länger beeinträchtigt.
* Fehlerbehandlung verbessert bei nicht-erfüllten Voraussetzungen:
  * Wenn bei einer Erweiterung per `ext.php` auf gültige Voraussetzungen geprüft wird, z.B. die phpBB oder PHP Version, dann wird bei negativem Ergebnis in der nachfolgenden Bestätigungsmeldung (nach Aktivierung) von EMP explizit darauf hingewiesen, dass die Voraussetzungen nicht erfüllt wurden. Dazu wird die original phpBB Fehlermeldung bezüglich nicht-erfüllter Voraussetzungen ausgegeben. Bisher konnte man in der Bestätigungsmeldung an der Angabe "x von y deaktivierten Erweiterungen wurden aktiviert." lediglich erkennen, ob Erweiterungen nicht aktiviert werden konnten. Es war jedoch nicht ersichtlich, welche Erweiterungen das betraf und auch nicht den jeweiligen Grund.
* Fehlerbehandlung verbessert bei Abbruch durch Erweiterungen mit eigenen Fehlermeldungen in `ext.php` (`trigger_error`):
  * Diese Funktion greift jetzt auch beim Deaktivieren, bisher war das nur beim Aktivieren der Fall.
  * Der partielle Log-Eintrag ist nun auch beim Deaktivieren möglich.
  * Es wird jetzt auch eine Bestätigungsmeldung (`successbox`) einer Erweiterung abgefangen. Auch eine positive Meldung bedeutet für EMP einen Abbruch.
  * Bei Abbruch einer Aktion durch eine Bestätigungsmeldung (`successbox`) seitens einer Erweiterung, wird diese Meldung in eine Fehlermeldung (`errorbox`) umgewandelt, da EMP durch diese Meldung ja unterbrochen wurde.
  * In der abgefangenen Fehlermeldung wird nun am Ende immer zusätzlich ein Zurück-Link hinzugefügt, mit der gleichen URL und Beschriftung ("Zurück zur Liste der Erweiterungen") wie sie phpBB bei den Bestätigungsmeldungen von "Aktivieren" und "Deaktivieren" verwendet. Der Grund dafür ist die Beobachtung, dass bei manchen Erweiterungen die Autoren vergessen haben, bei Fehlermeldungen einen Zurück-Link zu generieren.
* Sprachdateien:
  * Erklärung bei "Erlaube Migrationen" entschärft, da Migration-Exceptions nun abgefangen werden können. Der mögliche "Fatal error" war einer der Gründe für die bisherige Formulierung der Erklärung.
  * Neue Sprachvariable für die Auflistung aller Erweiterungen die nicht geschaltet werden konnten in einer Bestätigungsmeldung.
  * Kleinere Änderungen.

### 1.0.0

#### 1.0.0
* Release
* Benachrichtigungssystem so geändert, dass es nicht nur für ein veraltetes Sprachpaket genutzt werden kann. So war es eigentlich auch gedacht.

#### 1.0.0-b15
* Fix: War die Option Reihenfolge/Ignorieren ausgeschaltet, dann wurde die zugehörige Spalte nicht mehr mit den gespeicherten Werten befüllt. Hat man dann die leere Spalte gespeichert, wurde diese ausserdem gelöscht.

#### 1.0.0-b14
* Die Funktion Reihenfolge/Ignorieren ist nicht mehr Teil der Einstellungen, sondern ein separater Menüpunkt. Ist in der Handhabung angenehmer, da man dann nicht mehr so weit nach unten blättern muss und diese Funktion gehört technisch gesehen ohnehin nicht zu den Einstellungen. Es kann auch zwischen Einstellungen und Reihenfolge/Ignorieren gewechselt werden.
* ExtMgr Template:
  * Neue Option für Reihenfolge/Ignorieren hinzugefügt. Ist diese Option deaktiviert, wird der Menüpunkt "Reihenfolge/Ignorieren" abgeblendet.
* Core:
  * Code Optimierungen.
* JS:
  * An die Trennung von Einstellungen und Reihenfolge/Ignorieren angepasst.
* CSS:
  * An die Trennung von Einstellungen und Reihenfolge/Ignorieren angepasst.
* Sprachdateien:
  * Kleinere Änderungen.
  * Sprachvariablen für die neue Option Reihenfolge/Ignorieren hinzugefügt.

#### 1.0.0-b13
* Fix: Wenn Migrationen deaktiviert sind und bei Exts mit neuen Migrationsdateien zusätzlich noch das Ignorieren-Merkmal gesetzt wird, dann konnte es vorkommen, das die Alle-Deaktivieren Checkbox deaktiviert wird, obwohl es noch schaltbare Exts gab. Der Grund lag in der falschen Berechnung der schaltbaren Exts. [Meldung von Kirk]

#### 1.0.0-b12
* Fix: Beim Aktivieren wurden auch diejenigen Exts mit aktiviert, bei denen eine Reihenfolge-Gruppe definiert war, obwohl diese gar nicht ausgewählt wurden.
* Core:
  * Code Optimierungen.
* ExtMgr Template:
  * Tooltip für die Alle-Checkboxen hinzugefügt.
  * HTML optimiert. Unter anderem unnötige IDs bei Elementen entfernt, die auch per eindeutigen Namen angesprochen werden können.
  * Bis auf die Überschriften wird jetzt der Tabelleninhalt komplett von Twig Makros generiert. Reduziert redundanten Code und so hat man alles zentral.
* JS:
  * An die entfernten IDs angepasst.
* CSS:
  * An die entfernten IDs angepasst.
* Sprachdateien:
  * Sprachvariable für den Checkbox Tooltip hinzugefügt.
  * Kleinere Änderungen.
  
#### 1.0.0-b11
* CSS:
  * In der Responsive-Ansicht wird bei geöffneten Einstellungen der Button "Spalte speichern" zentriert, damit dieser optisch zu den anderen Buttons passt. [Vorschlag von Kirk]
  * In der Responsive-Ansicht wird bei geöffneten Einstellungen zwischen Erklärungen und Bedienelementen (Buttons, Radio Buttons) ein Abstand eingefügt.
  * Optimierungen.
  * Datei umstrukturiert.
* Sprachdateien:
  * Kleinere Änderungen.
* Core:
  * Code Optimierungen.
* JS:
  * Code Optimierungen.

#### 1.0.0-b10
* ExtMgr Template:
  * Bei der Option "Erlaube Migrationen" erfolgt jetzt eine Rückfrage per JS Popup die mit OK bestätigt werden muss. Ansonsten wird die Option wieder auf "Nein" zurückgestellt. [Vorschlag von Scanialady, chris1278]
  * Die neue Migrations-Rückfrage mit der Methode von LFWWH realisiert.
* Sprachdateien:
  * Neue Sprachvariablen für die Migrations-Rückfrage.
  * Den bestehenden Text bezüglich Erklärung für die Option "Erlaube Migrationen" so umformuliert, das der Text deutlich als Warnung wahrgenommen wird.

#### 1.0.0-b9
* Fix: In der Responsive-Ansicht wurde das Textfeld für Reihenfolge/Ignorieren auch dann angezeigt, wenn die Einstellungen nicht geöffnet waren. Um weitere Kopfschmerzen wegen dem phpBB Responsive CSS zu vermeiden, wird die Spalte jetzt wieder per Inline-CSS ausgeblendet, da das wenigstens unkompliziert funktioniert.
* Fix: In der Responsive-Ansicht wurde die Zeile mit dem Textfeld für Reihenfolge/Ignorieren nicht korrekt dargestellt, wenn die Einstellungen geöffnet waren.
* JS:
  * Funktion zum Anzeigen/Ausblenden der Einstellungen komplett geändert.

#### 1.0.0-b8
* Fix: In der Spalte für Reihenfolge/Ignorieren konnten keine 2-stelligen Werte eingetragen werden. Im HTML wurde schlicht das RegEx für die Eingabeprüfung falsch definiert. [Meldung von Kirk]
* In der Responsive-Ansicht werden nun auch bei den neuen EMP Spalten (neue Migrationsdateien, Auswählen, Reihenfolge/Ignorieren) einleitende Spaltenüberschriften angezeigt, wie das phpBB auch bei den Standard-Spalten macht. Bislang wurden gar keine Texte angezeigt, da die Spalten in der normalen Ansicht nur FA Icons enthalten.
* ExtMgr Template:
  * Wenn die Einstellungen geöffnet werden, dann werden jetzt in der Erweiterungen-Liste auch alle Links für "Aktivieren", "Deaktivieren" und "Arbeitsdaten löschen" ausgeblendet. Somit gibt es bei geöffneten Einstellungen nur noch die Textfelder als aktive Elemente in der Erweiterungen-Liste.
  * Sämtliches Inline-CSS entfernt. Damit enthält das HTML keinerlei Style-Definitionen mehr.
  * Weiteres XHTML entdeckt und entfernt.
  * Twig: Unnötige `{% if ... %}...{% endif %}` Konstrukte durch Ternarys ersetzt.
* Core:
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
