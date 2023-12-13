### 2.0.0
(2023--)

* Die Unterstützung für phpBB 3.2 wurde aufgegeben und sämtliche Anpassungen wurden entfernt. Minimum ist jetzt phpBB 3.3.0, optimal ist 3.3.8+.
* Freigegeben für PHP 8.3.
* Fix: Bei der Ermittlung neuer Migrationen verhinderte eine zu strikte Dateinamen-Prüfung eine korrekte Erkennung, wenn bei Dateinamen und Klassennamen abweichende Gross/Kleinschreibung verwendet wurde. Daraus ergaben sich 2 Fehler:
  * Bei aktivierter Anzeige der Spalte für neue Migrationen wurde die Anzahl falsch berechnet.
  * Ist die Aktivierung von Erweiterungen mit neuen Migrationen nicht erlaubt, wurde die Auswahl-Checkbox der betroffenen Erweiterung nicht gesperrt.
* Fix: Beim Betatest von 1.1.3 zeigte sich, dass EMP nicht mit ungültigen Erweiterungen umgehen konnte, wodurch sich mehrere Probleme ergaben:
  * In bestimmten Situationen konnte der Zähler für nicht-installierte Erweiterungen in den Minus-Bereich geraten. Da eine negative Anzahl nicht vorgesehen ist, wurde stattdessen die Zahl 18446744073709551615 angezeigt, da in der Sprachvariable ein anderer Variablentyp erwartet wurde. [Meldung von Kirk (phpBB.de)]
  * Bei negativer Anzahl der nicht-installierten Erweiterungen wurden alle deaktivierten Erweiterungen in der Sektion für nicht-installierte Erweiterungen angezeigt. [Meldung von Kirk (phpBB.de)]
  * Die Buttons "Ausgewählte deaktivieren" und "Ausgewählte aktivieren" wurden je nach Situation fälschlicherweise aktiviert.
  * Die Auswahlbox "Alle Erweiterungen auswählen" bei Aktivierte und Deaktivierte wurde je nach Situation fälschlicherweise aktiviert.
  * Die Zähler bei "Aktivierte Erweiterungen" und "Deaktivierte Erweiterungen" wurden je nach Situation falsch berechnet.
  * Bei Reihenfolge&Ignorieren wurden für ungültige Erweiterungen fälschlicherweise Eingabe-Elemente generiert, durch die beim Speichern falsche Daten in die DB geschrieben werden konnten.
* Fix: Das Problem mit dem erneuten Senden der Formulardaten beim Firefox (siehe nächsten Punkt) hatte einen Fehler von EMP aufgedeckt, der dann auftreten konnte, wenn Erweiterungen geschaltet wurden, ohne die ExtMgr Seite vorher neu zu laden. Wenn zwischen zwei Schaltvorgängen eine Erweiterung ungültig wurde, also die Metadaten der Erweiterung nicht mehr gelesen werden konnten, dann führte das zu einem FATAL der nicht abgefangen wurde. [Meldung von Kirk (phpBB.de)]
* Firefox Workaround: Wenn bei deaktivierter Rückfrage und aktivierter automatischer Bestätigung Erweiterungen geschaltet wurden und dann die ExtMgr Seite manuell neu geladen wurde (z.B. mit F5), dann führte das beim Firefox dazu, dass fälschlicherweise eine Rückfrage zum erneuten Senden der Formulardaten erschien. Wurde diese Rückfrage positiv bestätigt, dann wurde von EMP die letzte Aktion erneut ausgeführt, was je nach Situation zu Fehlern führen konnte. Eine neue Funktion rotiert jetzt die GET Parameter der URL bei einer automatischen Weiterleitung, was beim Firefox dazu führt, dass keine unnötige Rückfrage mehr bezüglich Formulardaten ausgelöst wird. Andere getestete Browser sind von dem Problem nicht betroffen. [Meldung von Kirk (phpBB.de)]
* In der Info-Tabelle wird hinter der Anzahl der verfügbaren Erweiterungen in Klammern auch die Anzahl ungültiger Erweiterungen angezeigt.
* Konnte die Versionsprüfung einer Erweiterung nicht erfolgreich ausgeführt werden, wird diese Information ebenfalls gespeichert und ausgewertet. Das funktioniert sowohl bei der globalen VP (Alle Versionen erneut prüfen), als auch bei der lokalen VP (Details).
  * In der Info-Tabelle wird hinter dem Datum der letzten Versionsprüfung die Anzahl Fehler angezeigt.
  * Bei Erweiterungen bei denen es Fehler bei der Versionsprüfung gab, wird ein orangefarbenes Warn-Icon mit Tooltip hinter der Version angezeigt.
* Da phpBB standardmässig nicht explizit darüber informiert, wenn eine Erweiterung keine Versionsprüfung bietet, füllt EMP nun auch diese Lücke. Somit können nun alle möglichen Zustände (VP erfolgreich/VP fehlerhaft/keine VP eingerichtet) entsprechend signalisiert werden.
  * Die Info-Tabelle oberhalb der Erweiterungen-Liste auf 4 Spalten erweitert. Neu ist die Anzahl der Erweiterungen mit eingerichteter Versionsprüfung.
  * Bei Erweiterungen bei denen keine Versionsprüfung eingerichtet ist, wird ein Icon (gebrochene Kette) mit Tooltip hinter der Version angezeigt.
* Weitere Änderungen bei der Versionsprüfung:
  * Bei einer Versionsprüfung werden jetzt alle Funktionen in der Link-Leiste gesperrt, die den Vorgang stören können.
  * Weiterhin werden die interaktiven Elemente in der Erweiterungen-Liste ausgeblendet, um versehentliche Aktionen zu verhindern, die den Vorgang stören können. [Vorschlag von chris1278 (phpBB.de)]
  * Zusätzlich informiert eine blaue Info-Box mit Hinweis über den Vorgang. [Vorschlag von chris1278 (phpBB.de)]
* Bei aktivierter Option "Letzten Zustand merken" wird die Auswahl der Kontrollkästchen bei aktivierter Rückfrage nur noch dann gespeichert, wenn die Rückfrage mit "Ja" bestätigt wird. Bei "Nein" wird die zuletzt gespeicherte Auswahl wiederhergestellt.
* Beim roten Ausrufezeichen-Icon (bei veralteten Versionen) ist jetzt ebenfalls ein Tooltip vorhanden.
* Ist die Funktion "Reihenfolge&Ignorieren" deaktiviert, wird auch kein unnötiges HTML mehr generiert für die Erklärungstexte, für den Absenden-Block sowie für die Inhalte der Spalten "Reihenfolge" und "Ignorieren".
* Ist Eigendeaktivierung aktiv und es wird beim Deaktivieren der Exts auch EMP mit ausgewählt, dann wird der Workaround bezüglich Cache-löschen nur noch dann ausgeführt, wenn phpBB <3.3.8 vorhanden ist. Dadurch gibt es keine Verzögerung mehr bei den nächsten beiden Seitenaufrufen, sondern nur noch einmal. Siehe auch "Mein Workaround" bei 1.0.7.
* Da der Schalter "Immer auf instabile Entwicklungs-Versionen prüfen:" in den Einstellungen nicht zu EMP gehört, wird dieser beim Zurücksetzen auf EMP Standard-Einstellungen nicht mehr berücksichtigt.
* Inline-ConfirmBox (jQuery)
  * Die Inline-ConfirmBox von EMP für die Generierung von Rückfragen in den Einstellungen, wurde zur Javascript Klasse `LukeWCSphpBBConfirmBox` umgebaut, die sämtliche Funktionen und Eigenschaften in einem einzigen Objekt zusammenfasst. Dadurch kann die ConfirmBox-Funktionalität sehr einfach in andere Erweiterungen integriert werden. Die Klasse bietet optional auch eine Animation (jQuery Standard), deren Geschwindigkeit per Klassen-Parameter definiert werden kann.
  * Ein- und Ausblenden wird jetzt mit Animation ausgeführt. [Vorschlag von IMC (phpBB.de)]
* Bei Toggles wird jetzt eine Bewegungs-Animation beim Slider verwendet, sowie eine Farb-Animation (Übergang) bei der Hintergrundfarbe. [Vorschlag von Kirk (phpBB.de)]
* Erweiterung ist jetzt kompatibel mit Toggle Control. Somit können Administratoren zentral an einer Stelle entscheiden, ob für Ja/Nein Schalter Radio Buttons, Checkboxen oder Toggles verwendet werden sollen.
* Code Optimierung:
  * JS:
    * Bei Javascript und jQuery wurden als DEPRECATED eingestufte Eigenschaften und Funktionen durch aktuelle Varianten ersetzt. Details siehe Build Changelog.
    * Umfangreiche Verbesserungen in Bezug auf Redundanz und unnötig umständlichen Code.
  * PHP
* Mehrere Kritikpunkte und Vorschläge bezüglich CSS berücksichtigt. [Vorschlag von Kirk (phpBB.de)]
* Sprachdateien:
  * Durch eine Änderung in 1.0.7 wurde eine Sprachvariable obsolet, diese wurde jedoch bisher nicht entfernt.

### 1.1.2
(2023-08-20)

* Fix: Wenn bei einer Erweiterung im Ordner `migrations` eine Datei ohne Suffix vorhanden war, wurde von EMP eine Debug Warnung ausgegeben: `Undefined array key "extension"`. [Meldung von Bruce Banner (phpBB.com)]
* Fix: Wenn bei einer Versionsprüfung mittels "Alle Versionen erneut prüfen" wegen Fehler eine oder mehrere Debug Meldungen erzeugt wurden, dann wurden diese von EMP effektiv unterdrückt. Der Grund war eine Änderung bei 1.1.1 durch die nach einer Versionsprüfung die URL mit einem Redirect bereinigt wurde. Der Redirect wurde entfernt. [Meldung von Kirk (phpBB.de)]
* Aufgrund der "Smilie Signs" Problematik wurde die Ignorieren-Funktion weiter ausgebaut. Wird bei einer Erweiterung das Ignorieren-Merkmal gesetzt, werden bei dieser Erweiterung auch keine neuen Migrationen ermittelt, da diese in so einem Fall ohnehin bedeutungslos sind. Ist die Spalte "Neue Migrationen" aktiviert, wird bei ignorierten Erweiterungen das entsprechende Ignorieren-Icon angezeigt, statt der Anzahl der neuen Migrationen.
* Ist bei einer Erweiterung das Ignorieren-Merkmal gesetzt, wird in der "Auswählen" Spalte nicht mehr ein deaktiviertes Kontrollkästchen angezeigt, sondern das gleiche Ignorieren-Icon wie in der "Neue Migrationen" Spalte. Somit gibt es nun in dieser Spalte einen optischen Unterschied zwischen ignorierten Erweiterungen und solchen, bei denen die Checkbox aufgrund von Bedingungen nicht zur Verfügung steht.
* Validierungs-Kritik 1.1.1:
  * Bei Versions-Anzeigen kann das Präfix "v" jetzt per Sprachvariable global angepasst werden.

### 1.1.1
(2023-05-28)

* Einstellungen:
  * Um die Last weiter zu reduzieren und den Weg für künftige Änderungen zu ebnen, gibt es für die Einstellungen jetzt ein separates ACP Modul. Der Link befindet sich auf der linken Seite in der Nav-Bar und lautet "Erweiterungen verwalten - Einstellungen".
  * Der Schalter bez. instabiler Versionen wird jetzt ebenfalls von der Funktion zum Zurücksetzen auf Installations-Standard berücksichtigt.
  * Es gibt nur noch einen gemeinsamen Absenden-Button. Bisher gab es zwei separate, einmal für den Schalter bez. instabiler Versionen und einmal für die Einstellungen von EMP. Das hatte zwar technische Gründe, war aber aus Benutzersicht irritierend. EMP übernimmt nun auch beim phpBB Schalter die Rückfrage und Speicherung.
  * Die Rückfragen erfolgen nicht mehr per modalem Javascript Dialog (`confirm()`), sondern per HTML und CSS. Dadurch wird Javascript nicht mehr angehalten und die Rückfrage öffnet und schliesst verzögerungsfrei. Dazu wird direkt unter dem betreffenden Schalter ein entsprechender Dialog eingeblendet.
  * Mit einem neuen Schalter kann festgelegt werden, ob positive Meldungen automatisch bestätigt werden sollen. Dabei wird nach 1 Sekunde zum Link weitergeleitet, der unterhalb jeder Meldung anklickbar ist. Das genügt um die grüne Box als Rückmeldung wahrnehmen zu können. Unterhalb der Meldung wird ein animiertes Icon angezeigt, als Indikator für die automatische Bestätigung. Fehlermeldungen sind von diesem Schalter nicht betroffen und müssen weiterhin manuell bestätigt werden.
* Versionsprüfung:
  * Icon von `fa-wifi` auf `fa-refresh` geändert.
  * Während der Ausführung der Versionsprüfung wird das zugehörige Icon jetzt animiert. Das dient als kleiner Indikator für die laufende Versionsprüfung, da phpBB selbst keinen Indikator bietet.
  * Nach der Ausführung der Versionsprüfung erfolgt ein Redirect auf die normale URL der "Erweiterungen verwalten" Seite. Dadurch wird verhindert, dass nach einer Versionsprüfung durch Neuladen der Seite erneut eine Versionsprüfung ausgeführt wird.
* Für Bestätigungsmeldungen und Fehlermeldungen ein eigenes Template hinzugefügt. Das Template basiert auf dem Original von phpBB und wurde so erweitert, dass bei allen Meldungen stets der ExtensionManager Titel, die ExtensionManager Beschreibung und die jeweilige Aktions-Erklärung (sofern zutreffend) von phpBB angezeigt wird. Zusätzlich wird auch der EMP Footer angezeigt. Damit verhält sich EMP auch bei Bestätigungen und Fehlermeldungen wie phpBB, da Meldungen stets in das ExtensionManager Template-Gerüst eingebettet sind.
* Prüfung auf gültige Migrationsdateien und zählen neuer Migrationen verbessert:
  * Beim Zählen der neuen Migrationen wurden unter Umständen auch Dateien als Migrationen erkannt, die kein gültiges PHP Suffix haben, zum Beispiel eine Sicherungsdatei (`.bak`) einer Migrationsdatei. Eine solche Datei kann zwar eine gültige Migration enthalten, wird aber von phpBB selber ignoriert. In einem Erweiterungs-Release kommen solche Dateien nicht vor bzw. sollten nicht vorkommen. In einem Entwickler Board sieht das jedoch anders aus. Ist kein gültiges PHP Suffix vorhanden, wird die Datei nicht mehr als gültige Migration gezählt.
  * Es wird zusätzlich geprüft, ob in einer Migrationsdatei die Klassen-Deklaration den exakten Dateinamen als Klassennamen enthält. Trifft das nicht zu, wird die Datei nicht mehr von EMP als gültige Migration gezählt, da sie auch von phpBB ignoriert wird.
* Die Überschriften für "Aktivierte/Deaktivierte/Nicht installierte Erweiterungen" stehen für Übersetzer jetzt als Sprachvariablen zur Verfügung, bei der die Anzahl per Platzhalter eingefügt wird.
* Die Funktion zum ermitteln der Versionsnummer des Sprachpakets sowohl strikter als auch flexibler gestaltet.
  * Strikter: Der Versions-String muss mit dem Muster x.y.z beginnen. Bisher wurde nicht geprüft, ob die Versionsnummer 3 Segmente hat.
  * Flexibler: Hinter einer gültigen Version dürfen Zusätze verwendet werden, wie z.B. ein viertes Segment oder ein Suffix.
* EMP Versionsprüfung von github.io auf phpbb.com geändert.
* Code Optimierung.

### 1.1.0
(2023-02-24 / CDB: 2023-04-22)

* Für die Handhabung der Auswahl-Kontrollkästchen steht eine neue Eigenschaft zur Verfügung, die es erlaubt, den letzten Zustand aller Kontrollkästchen speichern zu können. Das ist insbesondere bei phpBB Updates hilfreich, wenn man alle Erweiterungen deaktivieren will, aber auch Erweiterungen hat, die nur fallweise aktiviert werden sollen. Es werden automatisch alle Kontrollkästchen gespeichert, wenn die Aktion "Ausgewählte deaktivieren" oder "Ausgewählte aktivieren" ausgeführt wird. Zusätzlich kann auch in der Link-Leiste oberhalb der Erweiterungen-Liste mit der Aktion "Speichern" jederzeit die aktuelle Auswahl gespeichert werden.
* Erweiterungen-Liste:
  * Es wird jetzt auch bei den nicht installierten Erweiterungen die Anzahl neuer Migrationen angezeigt.
  * In der Überschrift "Deaktivierte Erweiterungen" wurde der Zusatz "(neue Migrationen: x)" entfernt.
* Einstellungen:
  * Die Spalte mit der Anzahl neuer Migrationen ist jetzt an die neue Experten-Option "Spalte mit neuen Migrationen anzeigen" gebunden. Diese ist per Standard deaktiviert.
  * Der Schalter "Kontrollkästchen setzen" wurde durch eine Optionsliste mit der Auswahl "Aus", "Alle setzen" und "Letzten Zustand merken" ersetzt.
* Einstellungen - Reihenfolge und Ignorieren:
  * Die Beschreibungen von Reihenfolge und Ignorieren werden nebeneinander statt untereinander dargestellt. [Vorschlag von Kirk]
  * Unterhalb der Erweiterungen-Liste wird ebenfalls ein Absenden-Button eingefügt. [Vorschlag von Kirk]
* Bisher wurde zum Ermitteln neuer Migrationen die Migrator Klasse von phpBB verwendet. Diese wurde entfernt, da sie mehrere Nachteile hat: 1) Die Klassen aller ermittelten Migrationen werden dauerhaft zur Laufzeit geladen (inkludiert) und zum Programm-Kontext hinzugefügt, wodurch unnötig Speicher belegt wird. 2) Erhöhtes Fehlerpotential, da beim Inkludieren eine defekte Migration zu einem Absturz (Fatal) von phpBB und damit von EMP führen kann. Um diese Probleme zu beheben, wurden eigene Funktionen für die Handhabung von Migrationen implementiert:
  * Für den Abgleich der lokalen Migrationen der Erweiterungen mit der Datenbank. Dabei wird festgestellt, welche Migrationen noch nicht ausgeführt wurden.
  * Für die Prüfung, ob eine Migrationsdatei tatsächlich eine Migration ist. Damit werden Dateien ausgefiltert, die lediglich eine Helfer-Klasse beinhalten.
* In allen Fehlermeldungen, die beim Deaktivieren oder Aktivieren auftreten können, wird jetzt auch immer die Version der betroffenen Erweiterung angezeigt. Das ist relevant, wenn im Supportfall Fehlermeldungen per Copy&Paste in Beiträgen eingefügt werden.
* Die Link-Leiste so gestaltet wie die Schnellzugriff-Leiste im Forenindex, mit individuellen Icons für jede Aktion.
* Code Optimierung.
  * Anzahl der MySQL Abfragen reduziert; etliche Funktionen und deren Aufrufe so geändert, dass Zugriffe auf `config_text` minimiert werden.
  * Mehrere Funktionsaufrufe reduziert; unter anderem durch Verwendung alternativer Funktionen und Neuordnung von Code.
  * Viele kleinere Verbesserungen.
* PHP Maximal-Version auf 8.2 erhöht.
* Sprachdateien:
  * "Migrationsdateien" global zu "Migrationen" geändert.
  * 9 Variablen hinzugefügt, 3 umbenannt, 1 entfernt.
  * Kleine Änderungen.
* Für Erweiterung-Autoren: Bei der Auswertung von `is_enableable` wird jetzt strikt nach phpBB Version unterschieden. Unverändert muss bei >=3.3.0 ein explizites `true` zurückgegeben werden, damit eine Erweiterung aktiviert werden kann. Bei <3.3.0 genügt jetzt auch ein implizites `true`. Damit verhält sich EMP identisch zur jeweiligen phpBB Minor Version, auf der es installiert ist.

### 1.0.8
(2023-02-01)

* Wird die Funktion "Details" ausgeführt und dabei eine neue Version der Erweiterung ermittelt, dann wird diese Information jetzt ebenfalls genutzt und im Versions-Cache von EMP gespeichert.
  * Dabei wird auch die Anzeige der Anzahl verfügbarer Updates oberhalb der Erweiterungen-Liste aktualisiert. Das Datum ändert sich in diesem Fall nicht und zeigt weiterhin das Datum der letzten regulären Versionsprüfung an.
  * Ebenso wird der entsprechende Update-Indikator der betreffenden Erweiterung in der Erweiterungen-Liste angezeigt, wie das auch bei der regulären Versionsprüfung der Fall wäre.
* Der Info-Tabelle oberhalb der Erweiterungen-Liste die Spalte "Verfügbare Updates" hinzugefügt, in der jetzt die Anzahl der Updates angezeigt wird. Somit sind Datum der letzten Versionsprüfung und Anzahl Updates in separaten Spalten aufgeführt.
* Bei den Aktionen "Ausgewählte deaktivieren" und "Ausgewählte aktivieren" wird jetzt oberhalb der Rückfrage der gleiche Hinweis angezeigt, den auch phpBB selbst bei der Rückfrage der Aktionen "Deaktivieren" und "Aktivieren" anzeigt. Somit verhält sich EMP auch in diesem Punkt wie phpBB.
* Einstellungen:
  * Wurde der Sicherheitsschalter "Erlaube Migrationen" aktiviert, dann wurde durch die modale Javscript Rückfrage `confirm()` verhindert, dass der Browser den aktivierten Zustand des Schalters darstellen konnte, da die Aktualisierung der Render Engine noch gar nicht beendet war. Jetzt wird gewartet bis diese Aktualisierung abgeschlossen ist, bevor der modale Dialog angezeigt wird.
  * Die Toggle Farben vom Recent Topics Fork übernommen. Insbesondere für Menschen mit Rot/Grün-Schwäche eine kleine Verbesserung.
  * Titel von "Migrationen erlauben" und Text der zugehörigen Rückfrage präzisiert, da diese etwas missverständlich waren.
* Code Optimierung:
  * PHP: Kleine Verbesserungen hinsichtlich Code Qualität.
  * Twig: Das `spaceless` Tag, welches seit Twig 2.7 als DEPRECATED eingestuft ist, wurde überall entfernt und durch `spaceless` Filter und Whitespace Modifier ersetzt.
* PHP Mindest-Version hat sich auf 7.1 erhöht.

### 1.0.7
(2022-12-04)

* Fix: Bei den Aktionen "Ausgewählte deaktivieren" und "Ausgewählte aktivieren" wäre es bei Überschreitung eines bestimmten Zeitlimits zu einem FATAL gekommen, da bei einem Funktionsaufruf unvollständige Parameter verwendet wurden. Funktionsaufruf komplett entfernt.
* Der Fix führte zu folgender Änderung: Bei den entsprechenden Aktionen wird jetzt die maximale PHP Ausführungszeit berücksichtigt. Wird während der Ausführung festgestellt, dass die Hälfte der maximalen Zeit überschritten wurde, wird die Aktion abgebrochen und eine kontrollierte Meldung angezeigt. Das ist allerdings ein Extremfall der vermutlich nur bei sehr vielen Exts mit zeitintensiven Aktionen in `ext.php` auftreten dürfte.
* Ist Eigendeaktivierung aktiviert und beim deaktivieren wurde auch EMP ausgewählt, dann wird in der Rückfrage - sofern aktiviert - gesondert darauf hingewiesen, dass auch EMP deaktiviert wird.
* Einstellungen:
  * Bei den Einstellungen werden für Ja/Nein-Optionen jetzt Checkboxen mit Toggle-Style verwendet. Dabei wurden für Menschen mit Farbseh-Schwäche (Rot/Grün Problematik und Farbblindheit) zwei Merkmale berücksichtigt: 1) Beibehaltung der gewohnten Positionen für Ja und Nein. 2) Eindeutige Symbole für die Zustände Ja und Nein. Toggle Funktionalität in angepasster Form von "Style Changer" übernommen. [Danke an Kirk]
  * Wie andere Erweiterungen von mir, bietet jetzt auch EMP die Möglichkeit die Einstellungen auf den Installation-Standard zurücksetzen zu können.
  * Die Buttons "Absenden" und "Zurücksetzen" befinden sich jetzt in einer eigenen Untergruppe die auf dieselbe Weise dargestellt wird, wie bei den ACP Seiten von phpBB.
  * Die Einstellungsgruppe "Reihenfolge/Ignorieren" hat jetzt die gleiche Button-Leiste wie die anderen Einstellungsgruppen, mit Ausnahme von "Zurücksetzen".
  * Im Header werden die Infos (Gesamtzahl, Versionsprüfung) nicht mehr in einer Blind-Tabelle dargestellt, sondern in einer phpBB Standard Tabelle. Wirkt ordentlicher und aufgeräumter.
  * Etliche kleinere Änderungen am ACP Template.
* Mein Workaround bezüglich Twig Cache Problematik, den ich in ähnlicher Form schon bei ExtOnOff 2.0.0 eingebaut hatte, wird ab phpBB 3.3.8 nicht mehr benötigt und wird in dem Fall jetzt von EMP übersprungen. Das wird durch eine Änderung im ExtensionManager von phpBB ermöglicht, die bei phpBB 3.3.8 eingebaut wurde. Durch das Überspringen des Workarounds reagiert das Forum nach dem schalten von Erweiterungen (Ausgewählte deaktivieren/aktivieren) nicht mehr bei den nächsten 2 Seitenaufrufen verzögert (wegen Cache Aufbau), sondern nur noch bei 1 Seitenaufruf, was wieder dem normalen Verhalten von phpBB entspricht. Bei phpBB <3.3.8 wird der Workaround weiterhin ausgeführt. Relevant: [phpBB #6359](https://github.com/phpbb/phpbb/pull/6359)
* Code Optimierung:
  * Bei Javascript, Twig und HTML. Unter anderem sind im HTML keine Javascript Events mehr definiert, diese werden direkt per jQuery registriert.
  * Bei PHP um die Last im ACP zu verringern.

### 1.0.6
(2022-11-05)

* Fix: Bei geleertem Cache wurde die Versionsprüfung zweimal ausgeführt, zuerst von EMP und anschliessend nochmal von phpBB: Falsche Event Reihenfolge und falscher Funktionsparameter.
* Fix: Wurde zwischen zwei Versionsprüfungen der Cache nicht geleert, erkannte EMP neue Updates nicht: Falsche Event Reihenfolge.
* Für das Ergebnis der letzten Versionsprüfung der Erweiterungen werden keine gesonderten Meldungen mehr generiert, sondern die schon vorhandenen Update-Indikatoren der Erweiterungen-Liste genutzt und erweitert. Das macht es insbesondere nach der ersten Erweiterung-Aktualisierung einfacher, gezielt die noch übrigen Erweiterungen zu deaktivieren und zu aktualisieren, wenn es mehr als ein Update gibt.
  * Die Update-Indikatoren werden automatisch entfernt, sobald die entsprechenden Erweiterungen aktualisiert wurden.
  * Statt der Meldungen wird jetzt dauerhaft das Datum der letzten Versionsprüfung angezeigt. Zusätzlich wird dahinter die Anzahl verfügbarer Updates in Klammern angezeigt. Die Anzahl wird automatisch angepasst, wenn Erweiterungen aktualisiert wurden. Der Zusatz wird komplett entfernt, wenn keine Updates mehr vorliegen.
  * Bereits vorhandene Daten der Versionsprüfung von 1.0.5 sind kompatibel mit dieser Version und werden übernommen.
* Code Optimierungen.
* Änderungen und Korrekturen bei CSS.

### 1.0.5
(2022-10-29)

* Das Ergebnis der letzten Versionsprüfung der Erweiterungen kann jetzt dauerhaft als Benachrichtigung angezeigt werden:
  * Bei der Versionsprüfung werden die Daten über neue Updates in der Datenbank gespeichert. Dadurch wird das Manko von phpBB behoben, dass diese Daten verlorengehen, sobald der Cache geleert wird.
  * In der Liste der Updates werden pro Erweiterung der Anzeigename, die neue Version und der Link zu den Details aufgeführt. In der Überschrift wird ausserdem das Datum der letzten Versionsprüfung angezeigt, im Datumsformat des Admins.
  * Wird eine Erweiterung aktualisiert, wird deren Meldung automatisch entfernt. Diese wird ebenfalls entfernt, wenn die Erweiterung komplett gelöscht wird.
  * Die neue Funktion ist per Standard aktiv und kann mittels neuer Einstellung deaktiviert werden. Wird sie deaktiviert, werden auch alle bestehenden Meldungen gelöscht.
* Da bei den Standardaktionen Aktivieren/Deaktivieren/Arbeitsdaten löschen/Details immer der original Seitentitel verwendet wird, den Zusatz "(Plus)" bei EMP im Titel entfernt um eine einheitliche Darstellung auf allen Seiten zu erreichen.
* Die Beschreibungen der Einstellungen für Reihenfolge/Ignorieren präzisiert, damit diese die gleichen Bezeichnungen für die EMP Buttons verwenden, wie die Beschreibungen der anderen Einstellungen.
* Die Funktion um Benachrichtigungen anzuzeigen - zur Zeit nur für ein veraltetes Sprachpaket - erzeugt kein HTML mehr, sondern übergibt lediglich eine Liste an das Template welches dann per Twig daraus HTML generiert.
* Code Optimierungen.

### 1.0.4
(2022-08-10)

* Fix: Die Funktion "Berechtigungen des Benutzers testen" führte zu einem Fatal: `Fatal error: Cannot declare class auth_admin, because the name is already in use in ...`. Die Ursache dafür ist die Migrator Klasse, die nicht per `services.yml` eingebunden werden darf. [Meldung von chris1278]

### 1.0.3
(2022-06-24)

* Fix: War die Funktion Reihenfolge/Ignorieren deaktiviert, wurden auch deren gespeicherten Daten nicht mehr geladen und konnten somit nicht mehr geändert werden. Hat man dann die leere Spalte gespeichert, wurden die Daten effektiv gelöscht. Um das zu verhindern, bleibt die Beschriftung des Links zu Reihenfolge/Ignorieren zwar weiterhin abgeblendet sichtbar wenn die Funktion deaktiviert ist, der Link wird jedoch entfernt und als Cursor erscheint das Gesperrt-Symbol.
* Reihenfolge/Ignorieren:
  * Für die Reihenfolge-Gruppe und das Ignorieren-Merkmal gibt es jetzt separate Spalten. Durch diese Trennung wird die Handhabung der ignorierten Erweiterungen komfortabler und ermöglicht so auch einen kurzfristigen Ausschluss ohne dazu eine vorhandene Reihenfolge-Gruppe entfernen zu müssen.
  * Wird das Ignorieren-Merkmal gesetzt, wird das zugehörige Textfeld für die Reihenfolge-Gruppe abgeblendet dargestellt, kann jedoch weiterhin geändert werden.
  * In den Einstellungen haben die Erklärungen für Reihenfolge/Ignorieren jetzt das entsprechende Spalten-Icon als Präfix.
  * Bereits vorhandene Daten für Reihenfolge/Ignorieren werden automatisch konvertiert.
* Code Optimierungen.

### 1.0.2
(2022-06-17)

* Bei der Prüfung ob eine Erweiterung aktiviert werden kann in Bezug auf Voraussetzungen (`ext.php`), wird jetzt auch die alternative Methode zur Fehlerbehandlung unterstützt, die bei phpBB 3.3.0 eingeführt wurde. Dabei kann der Erweiterung-Autor eine oder mehrere Fehlermeldungen an phpBB zurückgeben, statt diese Meldungen mittels `trigger_error` direkt auszugeben, was auch immer einen Abbruch der EMP Aktion zur Folge hat. Nutzt eine Erweiterung diese Methode, kann EMP auch im Fehlerfall problemlos mit der nächsten Erweiterung fortfahren, ohne das es zu einem Abbruch kommt. Ausserdem kann EMP die übergebenen Fehlermeldungen während der Aktivierung sammeln und in der Bestätigungsmeldung dann der Reihe nach auflisten. [Hinweis von IMC]
* Tooltips für die Icons der Spaltenüberschriften und für die Kontrollkästchen hinzugefügt.
* Das Formular für Reihenfolge/Ignorieren wird jetzt beim Speichern ebenfalls auf gültiges Security Token geprüft.
* Mehrere Änderungen in HTML und Javascript damit bestimmte Elemente flexibler angesprochen werden können. Das dient als Vorbereitung für künftige Funktionen.
* Code Optimierungen.

### 1.0.1
(2022-06-12)

* Allgemeine Fehlerbehandlung:
  * Die Bestätigungsmeldung von EMP wird nur noch dann als erfolgreich dargestellt (grüne `successbox`), wenn alle Erweiterungen geschaltet werden konnten. Wenn nur eine Erweiterung nicht geschaltet werden konnte, wird die Meldung als Fehler dargestellt (rote `errorbox`).
  * Bei Meldungen von EMP ist jetzt erkennbar, welche Texte von EMP und welche von phpBB oder von einer Erweiterung stammen. Diejenigen Texte die nicht von EMP stammen, werden kursiv dargestellt.
  * In allen Fehlermeldungen von EMP, wird jetzt der Anzeigename sowie der technische Name der betroffenen Erweiterung angezeigt, damit die Fehlermeldung zweifelsfrei zugeordnet werden kann. 
* Neue Fehlerbehandlung bei fehlgeschlagenen Migrationen: Ist die Option "Migrationen erlauben" aktiviert und es kommt während der Aktivierung einer Erweiterung mit neuen Migrationsdateien zu einem Fehler, dann führt das nicht länger zu einem "Fatal error" (quasi ein Absturz von phpBB). Stattdessen wird ein solcher Fehler abgefangen und eine kontrollierte Fehlermeldung ausgegeben.
* Fehlerbehandlung verbessert bei nicht-erfüllten Voraussetzungen: Wenn bei einer Erweiterung per `ext.php` auf gültige Voraussetzungen geprüft wird, z.B. die phpBB oder PHP Version, dann werden bei negativem Ergebnis in der abschliessenden Bestätigungsmeldung (nach Aktivierung) alle Erweiterungen aufgelistet mit der entsprechenden Fehlermeldung von phpBB. Bisher konnte man in der Bestätigungsmeldung lediglich sehen, wie viele Erweiterungen nicht aktiviert wurden, jedoch keine Details dazu.
* Fehlerbehandlung verbessert bei Abbruch durch Erweiterungen, die eigene Fehlermeldungen in `ext.php` generieren (`trigger_error`):
  * Diese Funktion greift jetzt auch beim Deaktivieren, bisher war das nur beim Aktivieren der Fall.
  * Der partielle Log-Eintrag ist nun auch beim Deaktivieren möglich.
  * Es wird jetzt auch eine Bestätigungsmeldung (`successbox`) einer Erweiterung abgefangen, da auch eine positive Meldung für EMP immer einen Abbruch bedeutet.
  * Bei Abbruch einer Aktion durch eine Bestätigungsmeldung (`successbox`) seitens einer Erweiterung, wird diese Meldung in eine Fehlermeldung (`errorbox`) umgewandelt, da EMP durch diese Meldung unterbrochen wurde.
  * In der abgefangenen Fehlermeldung wird am Ende immer zusätzlich ein Zurück-Link hinzugefügt, mit der gleichen URL und Beschriftung ("Zurück zur Liste der Erweiterungen") wie sie phpBB bei den Bestätigungsmeldungen von "Aktivieren" und "Deaktivieren" verwendet. Der Grund dafür ist, dass bei manchen Erweiterungen in den Fehlermeldungen ein Zurück-Link fehlt.

### 1.0.0
(2022-06-08)

* Erste öffentliche Version.
