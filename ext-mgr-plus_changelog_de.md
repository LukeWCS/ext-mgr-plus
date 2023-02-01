### 1.0.8
GH (2023-02-01)

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
* PHP Mindestversion hat sich auf 7.1 erhöht.

### 1.0.7
GH (2022-12-04)

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
* Mein Workaround bezüglich Twig Cache Problematik, den ich in ähnlicher Form schon bei ExtOnOff 2.0.0 eingebaut hatte, wird ab phpBB 3.3.8 nicht mehr benötigt und wird in dem Fall jetzt von EMP übersprungen. Das wird durch eine Änderung im ExtensionManager von phpBB ermöglicht, die bei phpBB 3.3.8 eingebaut wurde. Durch das Überspringen des Workarounds reagiert das Forum nach dem schalten von Erweiterungen (Ausgewählte deaktivieren/aktivieren) nicht mehr bei den nächsten 2 Seitenaufrufen verzögert (wegen Cache Aufbau), sondern nur noch bei 1 Seitenaufruf, was wieder dem normalen Verhalten von phpBB entspricht. Bei phpBB <3.3.8 wird der Workaround weiterhin ausgeführt. (Relevantes phpBB Update: https://github.com/phpbb/phpbb/pull/6359)
* Code Optimierung:
  * Bei Javascript, Twig und HTML. Unter anderem sind im HTML keine Javascript Events mehr definiert, diese werden direkt per jQuery registriert.
  * Bei PHP um die Last im ACP zu verringern.

### 1.0.6
GH (2022-11-05)

* Fix: Bei geleertem Cache wurde die Versionsprüfung zweimal ausgeführt, zuerst von EMP und anschliessend nochmal von phpBB: Falsche Event Reihenfolge und falscher Funktionsparameter.
* Fix: Wurde zwischen zwei Versionsprüfungen der Cache nicht geleert, erkannte EMP neue Updates nicht: Falsche Event Reihenfolge.
* Für das Ergebnis der letzten Versionsprüfung der Erweiterungen werden keine gesonderten Meldungen mehr generiert, sondern die schon vorhandenen Update-Indikatoren der Erweiterungen-Liste genutzt und erweitert. Das macht es insbesondere nach der ersten Erweiterung-Aktualisierung einfacher, gezielt die noch übrigen Erweiterungen zu deaktivieren und zu aktualisieren, wenn es mehr als ein Update gibt.
  * Die Update-Indikatoren werden automatisch entfernt, sobald die entsprechenden Erweiterungen aktualisiert wurden.
  * Statt der Meldungen wird jetzt dauerhaft das Datum der letzten Versionsprüfung angezeigt. Zusätzlich wird dahinter die Anzahl verfügbarer Updates in Klammern angezeigt. Die Anzahl wird automatisch angepasst, wenn Erweiterungen aktualisiert wurden. Der Zusatz wird komplett entfernt, wenn keine Updates mehr vorliegen.
  * Bereits vorhandene Daten der Versionsprüfung von 1.0.5 sind kompatibel mit dieser Version und werden übernommen.
* Code Optimierungen.
* Änderungen und Korrekturen bei CSS.

### 1.0.5
GH (2022-10-29)

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
GH (2022-08-10)

* Fix: Die Funktion "Berechtigungen des Benutzers testen" führte zu einem Fatal: `Fatal error: Cannot declare class auth_admin, because the name is already in use in ...`. Die Ursache dafür ist die Migrator Klasse, die nicht per `services.yml` eingebunden werden darf. [Meldung von chris1278]

### 1.0.3
GH (2022-06-24)

* Fix: War die Funktion Reihenfolge/Ignorieren deaktiviert, wurden auch deren gespeicherten Daten nicht mehr geladen und konnten somit nicht mehr geändert werden. Hat man dann die leere Spalte gespeichert, wurden die Daten effektiv gelöscht. Um das zu verhindern, bleibt die Beschriftung des Links zu Reihenfolge/Ignorieren zwar weiterhin abgeblendet sichtbar wenn die Funktion deaktiviert ist, der Link wird jedoch entfernt und als Cursor erscheint das Gesperrt-Symbol.
* Reihenfolge/Ignorieren:
  * Für die Reihenfolge-Gruppe und das Ignorieren-Merkmal gibt es jetzt separate Spalten. Durch diese Trennung wird die Handhabung der ignorierten Erweiterungen komfortabler und ermöglicht so auch einen kurzfristigen Ausschluss ohne dazu eine vorhandene Reihenfolge-Gruppe entfernen zu müssen.
  * Wird das Ignorieren-Merkmal gesetzt, wird das zugehörige Textfeld für die Reihenfolge-Gruppe abgeblendet dargestellt, kann jedoch weiterhin geändert werden.
  * In den Einstellungen haben die Erklärungen für Reihenfolge/Ignorieren jetzt das entsprechende Spalten-Icon als Präfix.
  * Bereits vorhandene Daten für Reihenfolge/Ignorieren werden automatisch konvertiert.
* Code Optimierungen.

### 1.0.2
GH (2022-06-17)

* Bei der Prüfung ob eine Erweiterung aktiviert werden kann in Bezug auf Voraussetzungen (`ext.php`), wird jetzt auch die alternative Methode zur Fehlerbehandlung unterstützt, die bei phpBB 3.3.0 eingeführt wurde. Dabei kann der Erweiterung-Autor eine oder mehrere Fehlermeldungen an phpBB zurückgeben, statt diese Meldungen mittels `trigger_error` direkt auszugeben, was auch immer einen Abbruch der EMP Aktion zur Folge hat. Nutzt eine Erweiterung diese Methode, kann EMP auch im Fehlerfall problemlos mit der nächsten Erweiterung fortfahren, ohne das es zu einem Abbruch kommt. Ausserdem kann EMP die übergebenen Fehlermeldungen während der Aktivierung sammeln und in der Bestätigungsmeldung dann der Reihe nach auflisten. [Hinweis von IMC]
* Tooltips für die Icons der Spaltenüberschriften und für die Checkboxen hinzugefügt.
* Das Formular für Reihenfolge/Ignorieren wird jetzt beim Speichern ebenfalls auf gültiges Security Token geprüft.
* Mehrere Änderungen in HTML und Javascript damit bestimmte Elemente flexibler angesprochen werden können. Das dient als Vorbereitung für künftige Funktionen.
* Code Optimierungen.

### 1.0.1
GH (2022-06-12)

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
GH (2022-06-08)

* Erste öffentliche Version.
