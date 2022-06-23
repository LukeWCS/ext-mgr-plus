### 1.0.3
GH (2022--)

* Fix: War die Funktion Reihenfolge/Ignorieren deaktiviert, wurden auch deren gespeicherten Daten nicht mehr geladen und konnten somit nicht mehr geändert werden. Hat man dann die leere Spalte gespeichert, wurden die Daten effektiv gelöscht. Um das zu verhindern, bleibt die Beschriftung des Links zu Reihenfolge/Ignorieren zwar weiterhin abgeblendet sichtbar wenn die Funktion deaktiviert ist, der Link wird jedoch entfernt und als Cursor erscheint das Gesperrt-Symbol.
* Reihenfolge/Ignorieren:
  * Für die Reihenfolge-Gruppe und das Ignorieren-Merkmal gibt es jetzt separate Spalten. Durch diese Trennung wird die Handhabung der ignorierten Erweiterungen komfortabler und ermöglicht so auch einen kurzfristigen Ausschluss ohne dazu eine vorhandene Reihenfolge-Gruppe entfernen zu müssen.
  * Wird das Ignorieren-Merkmal gesetzt, wird das zugehörige Textfeld für die Reihenfolge-Gruppe abgeblendet dargestellt.
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
