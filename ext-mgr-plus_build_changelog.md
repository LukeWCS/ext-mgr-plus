### 1.1.0

#### 1.1.0-b5
* Code Optimierung:
  * Anzahl MySQL Abfragen weiter reduziert: Zugriff auf ToDo Array (`config_text`) erfolgt nur noch dann, wenn entsprechende `config` Variable gesetzt ist.
  * Kleine Verbesserungen.
* Migration: Neue Config Variable `extmgrplus_exec_todo`.
* Versionsweiche beim Cache Workaround auf 3.3.8-rc1 präzisiert.

#### 1.1.0-b4
* Bei der Rückfrage wird jetzt ebenfalls der EMP Footer eingefügt.
  * Footer in ein extra Template ausgelagert.
* Code Optimierung:
  * Code bei Migration 1.0.3 optimiert, wodurch 4 unnötige Funktionsaufrufe entfielen.
  * Weitere Funktionsaufrufe im Core minimiert.

#### 1.1.0-b3
* Fix: Durch einen Fehler in 1.1.0-b2 hatten die Aktionen "Ausgewählte deaktivieren" und "Ausgewählte aktivieren" auch immer eine Selbstdeaktivierung von EMP zur Folge, wenn dabei auch eine beliebige ToDo Funktion (`purge_cache`, `add_log`) ausgeführt wurde.

#### 1.1.0-b2
* Code Optimierung:
  * Anzahl MySQL Abfragen reduziert: Mehrere Funktionen und deren Aufrufe so geändert, dass Zugriffe auf `config_text` minimiert wurden.
  * Anzahl Dateizugriffe reduziert: Die Prüfung ob eine Migrationsdatei tatsächlich eine Migration ist, findet nur noch bei Migrationen statt, die noch nicht in der DB registriert sind.
  * Kleine Verbesserungen.
* Sprachdateien:
  * "Reihenfolge/Ignorieren" zu "Reihenfolge & Ignorieren" geändert.
* ACP-Template:
  * Formale Fehler behoben.

#### 1.1.0-b1
* Spalte "Neue Migrationsdateien":
  * Die Anzahl wird jetzt auch bei nicht-installierten Erweiterungen angezeigt.
  * Die Spalte "Neue Migrationsdateien" kann jetzt ein/ausgeschaltet werden. Standard ist ausgeschaltet.
* Zum ermitteln der neuen Migrationsdateien wird nicht mehr die Migrator Klasse verwendet, sondern eigene Funktionen.
* In Fehlermeldungen wird jetzt zusätzlich die Version der betreffenden Ext angezeigt.
* Überschrift "Deaktivierte Erweiterungen":
  * Den Zusatz "(neue Migrationen: x)" entfernt.
* Sprachdateien:
  * Sprachvariablen hinzugefügt für die neue Option.
  * Eine Sprachvariable entfernt.
  * "Migrationsdateien" zu "Migrationen" geändert.
* JS:
  * Zurücksetzen-Funktion für die neue Option angepasst.
* Neue Migration 1.1.0:
  * Neue Config Variable `extmgrplus_enable_migration_col`.
* Code Optimierung.
* PHP Maximal-Version auf 8.2 erhöht:
  * `composer.json` angepasst.
  * `ext.php` angepasst.

### 1.0.8

#### 1.0.8
* Release
* Bei den Aktionen "Ausgewählte deaktivieren" und "Ausgewählte aktivieren" wird jetzt oberhalb der Rückfrage der gleiche Hinweis angezeigt, den auch phpBB selbst bei der Rückfrage der Aktionen "Deaktivieren" und "Aktivieren" anzeigt.
* Sprachdateien:
  * Texte bezüglich "Migrationen erlauben" präzisiert.
* ACP-Template:
  * Richtlinienfehler behoben. [Meldung von Kirk]
* Code:
  * Funktion zum deaktivieren/aktivieren auf 2 Funktionen aufgeteilt.
  * Optimierung.

#### 1.0.8-b2
* Wenn keine Updates ermittelt wurden, wird in der Info-Tabelle oberhalb der Erweiterungen-Liste jetzt "0" angezeigt statt "-".
* Code Optimierung:
  * PHP und Twig.

#### 1.0.8-b1
* Die Funktion "Details" im ExtMgr wird jetzt ebenfalls für den Versions-Cache von EMP genutzt. Das betrifft die Info-Tabelle oberhalb der Erweiterungen-Liste sowie die Update-Indikatoren in der Liste.
* Die Info-Tabelle oberhalb der Erweiterungen-Liste auf 3 Spalten erweitert. Datum und Anzahl Updates haben jetzt eigene Spalten.
* ACP-Template:
  * Das `spaceless` Tag, welches seit Twig 2.7 als DEPRECATED eingestuft ist, wurde entfernt. Stattdessen wird mit `spaceless` Filter und Whitespace Modifier gearbeitet.
  * Beim Sicherheitsschalter "Erlaube Migrationen" bekommt der Browser jetzt vor der Rückfrage (`confirm()`) genug Zeit um den aktivierten Schalter darstellen zu können.
* Code:
  * Funktionen ohne Rückgabewert als `: void` deklariert.
  * Variablen umbenannt.
  * Kleine Formfehler behoben.
* PHP Mindest-Version auf 7.1 erhöht:
  * `composer.json` angepasst.
  * `ext.php` angepasst.
* Sprachdateien:
  * Sprachvariable hinzugefügt für die Info-Tabelle.
  * Plural-Array für Updates entfernt.
* CSS:
  * Toggle Farben von Recent Topics übernommen.

### 1.0.7

#### 1.0.7
* Release
* Code Optimierung:
  * Die Funktion `catch_message()` wird jetzt frühzeitig abgebrochen, wenn sie nicht benötigt wird. Dadurch werden bei allen Seitenaufrufen im ACP 5 Funktionsaufrufe und 4 Bedingungen eingespart.

#### 1.0.7-b8
* Im Header werden die Infos (Gesamtzahl, Versionsprüfung) nicht mehr in einer Blind-Tabelle dargestellt, sondern in einer phpBB Standard Tabelle.
  * CSS der Blind-Tabelle entfernt.

#### 1.0.7-b7
* Die Prüfung auf Überschreitung der maximalen Ausführungszeit findet nur noch statt, nachdem eine Ext geschaltet wurde. Bisher wurde auch innerhalb `enable_step()` geprüft.
* Die Prüfung auf Überschreitung der maximalen Ausführungszeit findet nicht mehr vor dem Log Eintrag statt, sondern danach. So kann der Log Eintrag vor Abbruch noch aktualisiert werden.
* Ist Eigendeaktivierung aktiviert und beim deaktivieren wurde auch EMP ausgewählt, wird in der Rückfrage darauf hingewiesen, dass auch EMP deaktiviert wird.
  * Sprachvariable für den Hinweis hinzugefügt.
* Mein Workaround bezüglich Twig Cache Problematik der schon bei ExtOnOff 2.0.0 in ähnlicher Form eingebaut wurde, wird ab phpBB 3.3.8 nicht mehr benötigt. Details im regulären Changelog.

#### 1.0.7-b6
* Twig:
  * Bei 2 Makros unnötiges HTML und unnötigen ELSE Code eines Ternarys entfernt.
  * Optimiert, um im Output unnötige Whitespaces zu eliminieren. Speziell bei EMP dient das dazu, ein unschönes optisches Detail zu eliminieren, das durch unnötige Whitespaces entstanden ist.
* CSS:
  * Beim Toggle CSS einen kompakten Header eingefügt mit grundlegenden Infos und um Dan Klammer zu benennen, von dessen Webseite wir den CSS Code ursprünglich haben.
  
#### 1.0.7-b5
* EC Fehler (PSSE) behoben.
* ACP-Template:
  * Toggle CSS optimiert und in separate Datei ausgelagert.

#### 1.0.7-b4
* ACP-Template:
  * Wie andere Erweiterungen von mir, bietet jetzt auch EMP die Möglichkeit die Einstellungen auf Installation-Standard zurücksetzen zu können.
  * Eine `legend` Überschrift kann jetzt auch als Untergruppe eines `fieldset` Containers dargestellt werden. Bisher wurde eine solche Untergruppe nur per simplen `hr` dargestellt, dessen gestrichelte Linie nicht sonderlich schön aussah und auch mehr Platz benötigte, da die Linie in einer eigenen Zeile war.
  * "Absenden" und "Zurücksetzen" sind jetzt in einer eigenen Gruppe (`fieldset`), die auf dieselbe Weise dargestellt wird, wie bei ACP Seiten von phpBB.
  * Reihenfolge/Ignorieren: Den bisherigen Speichern-Button entfernt und stattdessen die übliche Buttonleiste zum Speichern eingefügt.
  * Slider verwenden jetzt wie bei Kirks Variante unterschiedliche FA Icons für die Zustände direkt im Slider. Dadurch werden die Labels "Ja" und "Nein" nicht länger benötigt und wurden entfernt. (Vorschlag von Scanialady)
  * `onchange` Event für die Bestätigung des Migration-Schalters entfernt.
  * `onchange` Events für Alle-Auswählen-Checkboxen entfernt.
  * `onchange` Events für Einzeln-Auswählen-Checkboxen entfernt.
  * `onchange` Events für Ignorieren-Checkboxen entfernt.
  * Twig optimiert.
* JS:
  * Funktion für zurücksetzen auf Standard hinzugefügt.
  * `onchange` und `onclick` Events werden jetzt direkt in jQuery registriert. Damit befinden sich im Template keine `on...` Events mehr, die zu EMP gehören.
  * Optimierung.
* CSS:
  * Klasse `legend_sub` hinzugefügt.
  * CSS für Toggles optimiert und den Slider minimal vergrössert, damit das FA Icon genug Platz hat und weniger CSS Anpassungen nötig sind.
* Sprachdateien:
  * Sprachvariablen umbenannt.
  * Sprachvariablen hinzugefügt.
  * Kleinere Änderungen.

#### 1.0.7-b3
* ACP-Template:
  * Neues Twig Makro für Ja/Nein Schalter 
  * Toggle Funktion in angepasster Form von "Style Changer" übernommen. (Danke an Kirk)
  * JS für Toggles angepasst.
  * CSS für Toggles angepasst.

#### 1.0.7-b2
* Fix: Bei 1.0.7-b1 hat sich durch Copy&Paste ein Fehler eingeschlichen, durch den die erweiterte Fehlerbehandlung für `ext.php` nicht mehr angezeigt wurde, die bei 1.0.2 eingebaut wurde.

#### 1.0.7-b1
* Bei den Aktionen "Ausgewählte deaktivieren" und "Ausgewählte aktivieren" wird jetzt die maximale PHP Ausführungszeit berücksichtigt. Wird während der Ausführung festgestellt, dass die Hälfte der maximalen Zeit überschritten wurde, wird die Aktion abgebrochen und eine kontrollierte Meldung angezeigt. Das ist allerdings ein Extremfall, der vermutlich nur bei sehr vielen Exts mit zeitintensiven Aktionen in `ext.php` auftreten dürfte. Durch diese Änderung wird verhindert, dass es während der Ausführung eventuell zu einem WSOD (White Screen Of Death) kommt, wodurch es so aussehen würde, als wäre phpBB/EMP eingefroren. Tatsächlich wird in so einem Fall die Ausführung des Skripts einfach vom Server abgebrochen und der Browser erhält keine Daten mehr.
* Im Style Ordner die Unterordner für CSS und JS entfernt. Für die paar wenigen Dateien sind Unterordner unnötig.
* ExtMgr Template:
  * Unnötigen Twig Code entfernt.
  * Kleinere Änderungen.
* Sprachdateien:
  * Neue Sprachvariablen für die Zeitüberschreitung-Meldung.
  * Kleinere Änderungen.

### 1.0.6

#### 1.0.6
* Release
* CSS:
  * Fix: Code für die 8te Spalte hat gefehlt.

#### 1.0.6-b4
* EC Fehler (VA) behoben.
* ExtMgr Template:
  * Twig Funktion für FA Icons.
  * Kleinere Änderungen.
* CSS:
  * Kleinere Änderungen.

#### 1.0.6-b3
* Fix: Bei geleertem Cache wurde die Versionsprüfung zweimal ausgeführt, von EMP und von phpBB.
* Fix: Wurde zwischen zwei Versionsprüfungen der Cache nicht geleert, erkannte EMP neue Updates nicht.
* Code Optimierung.
* ExtMgr Template:
  * Die Link-Leiste oberhalb der Erweiterungen-Liste wieder auf das Original Styling zurückgesetzt.
* CSS:
  * Nicht mehr benötigten Code entfernt.

#### 1.0.6-b2
* Im HTML und CSS war noch deaktivierter Code enthalten.
* Version der Sprachpakete korrigiert.
* `composer.json` auf die richtige Sprachversion geändert.

#### 1.0.6-b1
* Bei der Update Notification werden jetzt keine extra Meldungen mehr generiert, sondern direkt die schon vorhandenen Update Indikatoren der Liste genutzt und erweitert.
* Core:
  * Etlicher Code entfernt.
  * Code Optimierung.
* ExtMgr Template:
  * Twig für die Update Meldungen entfernt.
  * HTML für die Einstellung "Update Meldungen" entfernt.
  * Die original Update Indikator Funktion erweitert.
  * Dauerhafte Anzeige der letzten Versionsprüfung inklusive Anzahl verfügbarer Updates.
* CSS:
  * Anpassungen für die Anzeige der letzten Versionsprüfung.
* Sprachdateien:
  * Sprachvariablen entfernt.
  * Neue Sprachvariablen.
  * Kleinere Änderungen.
* Neue Migration.

### 1.0.5

#### 1.0.5
* Release
* Sprachdateien:
  * Kleine Textänderungen.

#### 1.0.5-b2
* Code Optimierungen:
  * Kleinere Änderungen für 1.0.5.
  * Unnötige Funktionsaufrufe bezüglich `get_metadata()` behoben.
  * Unnötige Funktion `remove_exts_with_new_migrations()` entfernt. Diese hatte ich für ExtOnOff 2.0 geschrieben und wird bei EMP nicht benötigt.
* Debugs entfernt.

#### 1.0.5-b1
* Neue Funktion für die dauerhafte Update Benachrichtigung nach einer Versionsprüfung hinzugefügt.
* Die Benachrichtigung-Funktion (Notes) erzeugt kein HTML mehr, das erledigt jetzt das Template durch Übergabe eines Arrays.
  * Entsprechende Funktion `add_note()` entfernt.
* ExtMgr Template:
  * Als Seitentitel wird jetzt wieder der Standard Titel verwendet, der Zusatz "(Plus)" ist hinfällig.
  * Twig Funktion eingebaut um das Array der Update Notification darstellen zu können.
  * Twig Funktion für Notes geändert um das Array darstellen zu können.
  * Neue Einstellungsgruppe für Update Notification hinzugefügt.
* Neue Migration für 2 neue Config Variablen.
* Sprachdateien:
  * Neue Sprachvariablen für Update Notification.
  * Texte präzisiert.
  * Variable für Seitentitel entfernt.

### 1.0.4

#### 1.0.4
* Release

#### 1.0.4-b1
* Fix für "Berechtigungen des Benutzers testen".

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
