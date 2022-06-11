### 1.0.1
GH (2022-06-)

* Allgemeine Fehlerbehandlung:
  * Die Bestätigungsmeldung von EMP wird nur noch dann als erfolgreich dargestellt (grüne `successbox`), wenn alle Erweiterungen geschaltet werden konnten. Bisher genügte dazu eine einzige, erfolgreich geschaltete Erweiterung. Wenn nur eine Erweiterung nicht geschaltet werden konnte, wird die Meldung als Fehler dargestellt (rote `errorbox`).
  * Bei Meldungen von EMP ist jetzt immer erkennbar, welche Texte von EMP und welche von phpBB oder von einer Erweiterung stammen. Diejenigen Texte die nicht von EMP stammen, werden immer kursiv dargestellt.
  * In allen Fehlermeldungen von EMP, wird jetzt immer der Anzeigename sowie der technische Name der betroffenen Erweiterung angezeigt, damit die Fehlermeldung zweifelsfrei zugeordnet werden kann. 
* Neue Fehlerbehandlung bei fehlgeschlagenen Migrationen: Ist die Option "Migrationen erlauben" aktiviert und es kommt während der Aktivierung einer Erweiterung mit neuen Migrationsdateien zu einem Fehler, dann führt das nicht länger zu einem "Fatal error" (quasi ein Absturz von phpBB). Stattdessen wird ein solcher Fehler abgefangen und als kontrollierte Fehlermeldung ausgegeben. Auf diese Weise behält EMP die Kontrolle und damit auch der Administrator.
* Fehlerbehandlung verbessert bei nicht-erfüllten Voraussetzungen: Wenn bei einer Erweiterung per `ext.php` auf gültige Voraussetzungen geprüft wird, z.B. die phpBB oder PHP Version, dann wird bei negativem Ergebnis in der nachfolgenden Bestätigungsmeldung (nach Aktivierung) von EMP explizit darauf hingewiesen, dass die Voraussetzungen nicht erfüllt wurden. Bisher konnte man in der Bestätigungsmeldung lediglich sehen, wie viele Erweiterungen aktiviert wurden, jedoch keine Details zu nicht-aktivierten Erweiterungen.
* Fehlerbehandlung verbessert bei Abbruch durch Erweiterungen, die eigene Fehlermeldungen in `ext.php` generieren (`trigger_error`):
  * Diese Funktion greift jetzt auch beim Deaktivieren, bisher war das nur beim Aktivieren der Fall.
  * Der partielle Log-Eintrag ist nun auch beim Deaktivieren möglich.
  * Es wird jetzt auch eine Bestätigungsmeldung (`successbox`) einer Erweiterung abgefangen, da auch eine positive Meldung für EMP immer einen Abbruch bedeutet.
  * Bei Abbruch einer Aktion durch eine Bestätigungsmeldung (`successbox`) seitens einer Erweiterung, wird diese Meldung in eine Fehlermeldung (`errorbox`) umgewandelt, da EMP durch diese Meldung ja unterbrochen wurde.
  * In der abgefangenen Fehlermeldung wird am Ende immer zusätzlich ein Zurück-Link hinzugefügt, mit der gleichen URL und Beschriftung ("Zurück zur Liste der Erweiterungen") wie sie phpBB bei den Bestätigungsmeldungen von "Aktivieren" und "Deaktivieren" verwendet. Der Grund dafür ist die Feststellung, dass bei manchen Erweiterungen die Autoren vergessen haben, bei Fehlermeldungen einen Zurück-Link zu generieren.

### 1.0.0
GH (2022-06-08)

* Erste öffentliche Version.
