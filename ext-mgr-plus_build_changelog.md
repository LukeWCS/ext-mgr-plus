#### 3.1.0-b11
* Die Generierung der "Details" Seite hat sich grundlegend geändert. Das Ziel war es, die zusätzlichen Links von EMP direkt im Abschnitt "Informationen zur Erweiterung" einfügen zu können, wie das auch ursprünglich vorgesehen war. Dazu waren folgende Änderungen notwendig:
  * EMP generiert nun selber die "Details" Seite. Dazu wurde das original Template `acp_ext_details.html` mittels "Twig Converter" exportiert und an den Code Stil und Layout von EMP angepasst. Ein eigenes Template vereinfacht ausserdem mögliche zukünftige Änderungen der Seite.
  * Das ACP Event Template `acp_ext_details_end.html` wird nicht länger benötigt und wurde samt dem Ordner `adm/style/event` entfernt.
  * Die Sprachvariable `EXTMGRPLUS_SECTION_DETAILS` wurde entfernt, da nicht länger benötigt.
* LukeWCSphpBBConfirmBox 1.5.0:
  * Code bereinigt bei HTML, JS und CSS.
* Sprachdateien:
  * In der Sprachdatei `de_x_sie/acp_ext_mgr_plus.php` war die Variable `EXTMGRPLUS_DETAILS_VERSION_URL` an der falschen Stelle.

#### 3.1.0-b10
* Fix: Bei b9 wurde Responsive bei der Änderung der Breite des Erklärungstextes auf 45% nicht berücksichtigt. [Meldung von Kirk (phpBB.de)]
* LukeWCSphpBBConfirmBox 1.5.0:
  * Twig:
    * Für den `div` Container wird kein individuelles `id` Attribut mehr generiert, sondern eine Klasse. Der individuelle Element-Name wird jetzt per `data-name` Attribut definiert.
    * Die Namen der Buttons enthalten nicht mehr den Element-Namen des Schalters, sondern feste Namen.
  * JS:
    * Zugriffe auf das ConfirmBox Element erfolgen nicht mehr per `id`, sondern per Klasse und je nach Situation zusätzlich über das `data-name` Attribut.
    * Bei den Buttons wird der Element-Name nicht mehr aus den Button-Namen extrahiert, sondern vom `data-name` Attribut des übergeordneten `div` Containers bezogen.
    * Bei aktiver Rückfrage wird bei gesperrten Elementen nicht mehr die Klasse `confirmbox_active` gesetzt, sondern `lukewcs_confirmbox_active`.
    * Optimierung.
  * CSS: an Twig und JS angepasst.

#### 3.1.0-b9
* Settings Template:
  * Makro `button` entfernt und HTML direkt notiert. Ein Makro ist hier nicht sinnvoll, da es zu viele variable Eigenschaften und Kombinationen geben kann.
  * Den Schalter "Anleitungen anzeigen" in den Abschnitt "Experten-Einstellungen" verschoben.
* CSS:
  * Für den Erklärungstext unterhalb der Legende für "Experten-Einstellungen" wird nicht mehr die gesamte verfügbare Breite genutzt, sondern die Breite begrenzt wie bei `dt`, also auf 45%.
* Sprachdateien:
  * Den Erklärungstext für "Experten-Einstellungen" so angepasst, dass dieser auch zum verschobenen Schalter passt.
  * Die Variablen für "Anleitungen anzeigen" ebenfalls verschoben.

#### 3.1.0-b8
* Fix: Durch das geänderte Twig Makro `icon`, bei dem jetzt direkt ein Tooltip definiert werden kann, wurden 2 Fehler verursacht:
  * In der Spalte "Aktuelle Version" war der Abstand zwischen erster Version und Icon (sofern vorhanden) zu gross. Verursacht wurde das durch die unnötigen Whitespaces (25 Tabs) die vom `spaceless` Filter nicht mehr entfernt werden konnten, da sich zwischen den verschiedenen Tags auch normaler Text befand; das erzwungene Leerzeichen `&nbsp;`. Dadurch wurden effektiv 2 Leerzeichen eingefügt statt 1.
    * Template: In dieser Spalte alle erzwungenen Leerzeichen im Twig Code entfernt.
    * CSS: Stattdessen wird jetzt per CSS individuell vor dem Icon oder nach dem Icon oder in beiden Fällen ein Abstand eingefügt.
  * In der Spalte "Migrationen" wurde bei Icons kein Hilfe-Cursor mehr dargestellt, weil das CSS nur für `span` ausgelegt war.
    * CSS: Regel für `i.icon` erweitert.
* Fix: Durch die Änderung von `input` auf `button` im ConfirmBox Template wurde das EMP Padding für diese Buttons nicht mehr angewendet.
  * CSS: Regel für `button` angepasst.
* Makros Template:
  * Bei `icon` den Parameter `decorative` von Position 2 auf 3 geändert, damit man sich bei Icons mit Tooltip in den meisten Fällen die unnötige Angabe `, true` sparen kann.
* ExtMgr Template:
  * Im Tabellen-Kopf werden Tooltips nicht mehr auf das `th` Element angewendet, sondern durch das `icon` Makro erzeugt.
* CSS:
  * Bei den Buttons "Ausgewählte deaktivieren" und "Ausgewählte aktivieren" ist das vertikale Padding wieder auf `1px` gesetzt, damit die Buttons etwas niedriger dargestellt werden.
  * Es wird jetzt auch bei Icons im Tabellen-Kopf der Hilfe-Cursor dargestellt.
  * Die verschiedenen Bereiche sind jetzt deutlicher gekennzeichnet, durch einen einleitenden und abschliessenden Kommentar mit `>` und `<`.
  * Optimierung.

#### 3.1.0-b7
* CSS:
  * Bei den Aktionen "Ausgewählte deaktivieren" und "Ausgewählte aktivieren" werden jetzt wieder wie gehabt Buttons verwendet mit 2 kleinen Änderungen:
    * Die Buttons sind in der vertikalen nach oben und unten jeweils ein 1 Pixel höher.
    * Die Schrift ist jetzt genauso gross wie der Text der Überschrift links daneben. Somit ist die gesamte Überschrift einheitlich was Schrift angeht.

#### 3.1.0-b6
* ConfirmBox Template:
  * Beim original Extension Manager werden beim Schalten der Erweiterungen bei der Rückfrage die Button Beschriftungen "Deaktivieren / Abbrechen" und "Aktivieren / Abbrechen" verwendet, was bei EMP bisher nicht möglich war, da bei der phpBB Funktion `confirm_box` aus technischen Gründen "Ja / Nein" verwendet werden muss. Für diese Buttons werden jetzt `<button>` Elemente verwendet, bei denen Beschriftung und Wert unabhängig definiert werden kann. Somit verhält sich EMP nun auch bei der Rückfrage vollständig wie das Original. Werden im Controller keine alternativen Beschriftungen definiert, gilt automatisch "Ja / Nein".
  * Für den Hinweis bei Eigendeaktivierung wird keine separate Template Variable mehr benötigt, sondern 2 andere ausgewertet.
* Makros Template:
  * Beim Makro `icon` kann jetzt als dritter Parameter eine Sprachvariable für einen Tooltip übergeben werden, wodurch sich mehrere Vorteile ergeben:
    * Es wird für den Tooltip kein umschliessender  `span` Container mehr benötigt, da dies direkt im `i` Container des Icons geregelt werden kann.
    * Neben dem `span` Container ist es ebenfalls nicht mehr nötig das HTML Attribut `title`, sowie die Twig Funktion `lang()` und den Twig Filter `e('html')` notieren zu müssen. Somit einfacherer und kompakterer Template Code.
* Core:
  * Für das EMP-eigene Template der `confirm_box` Funktion von phpBB können jetzt alternative Button Beschriftungen definiert werden.
  * Die Generierung der Template-Variable bei Eigendeaktivierung entfernt.
* CSS:
  * Die Buttons "Ausgewählte deaktivieren" und "Ausgewählte aktivieren" haben jetzt das Aussehen und Verhalten von normalen Links, wie die anderen Funktionen der Spalte "Vorgänge". Das betrifft auch die Schriftgrösse, die jetzt wieder dem normalen Wert entspricht und somit grösser ist, als es bei den Buttons der Fall war.
  * Die original Button Regeln weitestgehend von phpBB übernommen, damit bei der Rückfrage die geänderten Buttons weiterhin wie originale phpBB Buttons aussehen.
  * Optimierung.

#### 3.1.0-b5
* Core:
  * Code Bereinigung bezüglich Einstellungen-Links; veralteter und bereits auskommentierter Code endgültig entfernt, ansonsten keine Änderungen. Somit betrachte ich die Entwicklung der neuen Funktion erst mal als abgeschlossen.
  * Code Optimierung.

#### 3.1.0-b4
* Fix: Wenn die PHP INI Variable `max_execution_time` den Wert `0` aufweist, dann bekommt die von phpBB generierte Variable `safe_time_limit` im original ExtMgr ebenfalls den Wert `0`, bedingt durch die Formel `safe_time_limit = max_execution_time / 2`. Das hatte zur Folge, dass beim Schalten von Erweiterungen fälschlicherweise der Timeout-Schutz von EMP gegriffen hat und die Aktion nach der ersten geschalteten Erweiterung abgebrochen wurde. Bei einem Wert `0` wird diese Prüfung jetzt korrekt übersprungen, da es in diesem Fall laut PHP Konfiguration keine Laufzeit-Begrenzung gibt. Das ist zwar ein eher exotisches Problem und wird so in der Realität kaum/selten auftreten, ist jedoch trotzdem ein Fehler gewesen. [Meldung von Scanialady (phpBB.de)]
* Nach Umbau der Funktion zur Generierung der Einstellungen-Links ist aufgefallen, dass es ebenfalls nicht länger notwendig ist, die Module mit der Liste der aktivierten Erweiterungen abzugleichen und daher wurde das jetzt auch entfernt.

#### 3.1.0-b3
* Achtung, Migration hat sich geändert! Bitte b2 deinstallieren bevor b3 installiert wird. Oder in der DB in der Tabelle `_config` die Änderung selber ausführen, wie hier unter "Migration" aufgeführt und dann den phpBB Cache löschen.
* Die Funktion zur Generierung der Einstellungen-Links komplett umgebaut. Anstatt einen eigenen SQL Query auszuführen und die Modul-Hierarchie sowie die Modul-Rechte selber zu prüfen, wird jetzt direkt auf das fertige Modul Array von phpBB zugegriffen, bei dem die Hierarchie und Rechte bereits berücksichtigt sind. So muss EMP nur noch prüfen, ob ein Modul sichtbar ist, was in einem deutlich kompakteren Code resultiert.
* Migration:
  * Config Variable `extmgrplus_switch_setting_links` umbenannt in `extmgrplus_switch_settings_link`.
* PHP, HTML und JS an den geänderten Variablennamen angepasst.

#### 3.1.0-b2
* Die Generierung der Einstellungen-Links kann jetzt optional deaktiviert werden. [Vorschlag von chris1278 (phpBB.de)]
  * Neuen Schalter im Settings Template eingefügt.
  * Schalter im Controller verdrahtet.
  * Schalter im Core verdrahtet.
  * Schalter im ExtMgr Template verdrahtet.
  * Standard-Einstellungen für den Schalter angepasst (JS).
  * 2 neue Sprachvariablen für den Schalter.
* Core:
  * Code Optimierung.
* Details Template:
  * Da für die Anzeige der zusätzlichen Informationen ein Event genutzt wird, ist ein Footer hier nicht ideal und wurde entfernt.
    * Einbindung (`import`) der EMP Makros entfernt.
    * Einbindung (`INCLUDECSS`) des EMP CSS entfernt.
* Migration:
  * Neue Config Variable `extmgrplus_switch_setting_links`.

#### 3.1.0-b1
* In der Spalte "Vorgänge" gibt es den neuen Link "Einstellungen", mit dem direkt das primäre Einstellungsmodul einer Erweiterung aufgerufen werden kann, also das erste Modul das per Migration installiert wurde.
  * Dabei wird die Modul-Einstellung "Modul anzeigen:" respektiert; ist diese Einstellung deaktiviert, generiert EMP kein Link zum Modul.
  * Ebenso wird auch die Modul-Einstellung "Modul aktiviert:" aller übergeordneten Gruppen/Kategorien berücksichtigt; ist diese Einstellung bei einem Element in der Hierarchie deaktiviert, steht auch bei EMP kein Link zu diesem ACP Modul zur Verfügung.
  * Auch die individuellen Modul-Rechte werden berücksichtigt; hat der Admin kein Recht für ein Einstellungsmodul, wird kein Link zum Modul generiert.
* Core:
  * Code Optimierung.
* ExtMgr Template:
  * Kleine Korrekturen.

### 3.0.0
* Release (2024-11-28)
* Umstellung der Version 2.1.0 auf 3.0.0.
* Settings Template:
  * Den Schalter für Reihenfolge&Ignorieren in die neue, separate Sektion "Eigenschaften der Erweiterungen" verschoben.
  * Die Sektion für die Experten-Einstellungen hat jetzt eine kurze Einleitung.
* Sprachdateien:
  * 1 Variable hinzugefügt für die neue Sektion.
  * 1 Variable hinzugefügt für die neue Einleitung.
  * Kleinere Textänderungen.
* Beschreibung in `composer.json` um blockweise Versionsprüfung erweitert.
* Core:
  * VP SIM entfernt.

#### 2.1.0-b18
* Fix: Bei Aktivierung einer Ext mit fehlgeschlagener Migration wurde beim Vorgang nur die Sprachvariable `EXTMGRPLUS_ALL_ENABLE` angezeigt, anstatt dem Text.

#### 2.1.0-b17
* ExtMgr Template:
  * Eigenschaften der Erweiterungen:
    * Den Link "Reihenfolge & Ignorieren" umbenannt zu "Eigenschaften der Erweiterungen".
    * Neues Icon für diesen Link; Zahnräder-Symbol.
    * Im aufgeklappten Formular werden nicht verfügbare Elemente jetzt entweder abgeblendet dargestellt (Erklärungen) oder nicht erzeugt (Spalteninhalte). Stehen gar keine Eigenschaften zur Verfügung, wird der Link zum Öffnen des Formulars nicht angeboten, wie es bisher bei Reihenfolge&Ignorieren der Fall war.
    * Den ersten Satz der Erklärungen auf der linken Seite unterhalb der Labels entfernt und wieder bei den Erklärungen auf der rechten Seite eingefügt. Somit noch kompakter und weniger Code und Variablen nötig.
    * CSS und JS an die Änderungen angepasst.
  * Twig Optimierung.
* Core:
  * An die Änderungen bez. "Eigenschaften der Erweiterungen" angepasst.
* Sprachdateien:
  * 2 Variablen umbenannt.
  * 2 Variablen entfernt.
  * 5 Variablen geändert.

#### 2.1.0-b16
* Fix: 2 Syntax-Fehler in einem jQuery Selektor behoben, die jedoch seltsamerweise keine Auswirkungen hatten.
* Core:
  * Template Variablen für die verschiedenen Zähler werden nicht mehr als separate Variablen, sondern als Array generiert um dynamischen Zugriff zu vereinfachen.
* ExtMgr Template:
  * Twig an das neue Zähler-Array angepasst.
  * Unnötige Klasse `extmgrplus_responsive` entfernt und stattdessen Inline-CSS definiert.
  * Änderungen bei Reihenfolge & Ignorieren:
    * Um zukünftige Änderungen zu vereinfachen, wie z.B. das Hinzufügen einer weiteren Spalte, werden die Erklärungen jetzt nicht mehr nebeneinander, sondern untereinander dargestellt. Dabei werden die Erklärungen innerhalb von Spoiler-Boxen angezeigt, damit die Anzeige kompakt gehalten werden kann. Durch diese Änderung entspricht Reihenfolge & Ignorieren auch wieder mehr einem normalen ACP Modul, bei dem Labels links und interaktive Elemente rechts angeordnet sind.
	* Das FA Icon wird nicht mehr in der Beschreibung angezeigt, sondern im Label.
  * Optimierung.
* CSS:
  * Icons im Label für Reihenfolge & Ignorieren minimal grösser definiert und Fettschrift entfernt, dadurch deutlich besser erkennbar.
  * CSS für die Spoiler-Funktion hinzugefügt.
  * Nicht mehr benötigtes CSS für die alte Darstellung von Reihenfolge & Ignorieren entfernt, inklusive Responsive Code.
* Sprachdateien:
  * 4 Variablen umbenannt um dynamischen Zugriff zu vereinfachen.
  * 4 Variablen an die Änderungen im Template angepasst.
  * 3 Variablen für die Spoiler-Funktion hinzugefügt.
  * 1 Variable überarbeitet.

#### 2.1.0-b15
* ExtMgr Template:
  * Anpassung für phpBB 3.3.14 komplett geändert. Anstatt 3 separate `for` Schleifen auszuführen, wird jetzt 3 mal dieselbe Schleife ausgeführt, wodurch der redundante Code für die separaten Listen entfallen konnte. Dadurch konnten auch sämtliche Spalten-Makros entfallen. Durch diesen Umbau ist die Generierung wieder näher am Original und der Umfang des Templates reduziert sich um rund 4KB und 150 Zeilen. Ausserdem Twig optimiert.
* Core:
  * Optimierung.

#### 2.1.0-b14
* Beta Fix: Bei ungültigen Erweiterungen wurden die Spalten "Auswählen", "Reihenfolge" und "Ignorieren" angeboten, die in dieser Situation gar nicht vorhanden sein dürfen. Das hängt mit den Änderungen von b11 und b12 zusammen, da hier fälschlicherweise notwendige Abfragen entfernt wurden. Ebenso wird jetzt auch das orange Fragezeichen in der Spalte "Aktuelle Version" unterdrückt, welches bei b4 eingebaut wurde und in dieser Situation ebenfalls fälschlicherweise angezeigt wurde.
* Code Optimierung.

#### 2.1.0-b13
* Beta Fix: Wenn bei einer Erweiterung ohne Versionsprüfung die "Details" aufgerufen wurde, erschien die Fehlermeldung "Undefined variable $vc_current". Fehlende VP Daten wurden ab b8 an dieser Stelle nicht mehr berücksichtigt.
* ExtMgr Template:
  * Die Anpassung bei b12 für phpBB 3.3.14 komplett geändert. Anstatt die Arrays für deaktivierte und nicht-installierte Erweiterungen wieder zusammenzuführen, wie es bei phpBB <3.3.14 standardmässig der Fall war, gibt es jetzt eine zusätzliche Schleife, in der die nicht-installierten Erweiterungen separat verarbeitet werden. Somit ist die Verarbeitung der Arrays wieder mit phpBB 3.3.14 vergleichbar. Bei phpBB <3.3.14 wird dazu das fehlende Array `not_installed` der nicht-installierten Erweiterungen direkt im Template erzeugt, damit die weitere Verarbeitung identisch bleiben kann. Durch diese Änderung konnten auch 3 Twig Abfragen entfallen: 1 einmalige und 2 mehrfache Abfragen innerhalb einer `for` Schleife.
  * Der Name für das Template Array der nicht-installierten Erweiterungen sowie die 2 neuen Event-Namen wurden bei 3.3.14-rc1 nochmals geändert, siehe [phpBB #6743](https://github.com/phpbb/phpbb/pull/6743). Entsprechend den Twig Code angepasst. Somit ist EMP 2.1.0 mit der spezifischen phpBB Version 3.3.14-rc1 nicht mehr kompatibel.
* Definierte Reihenfolge-Gruppen werden jetzt auch beim Deaktivieren berücksichtigt, in umgekehrter Reihenfolge.
* Core:
  * Den bei b11 deaktivierten Code (ToDo Funktion, Cache Workaround) endgültig entfernt.
  * Da jetzt im Template die Information benötigt wird, ob mindestens phpBB 3.3.14 vorhanden ist, wird dafür eine neue Template Variable generiert.
  * Weiteren Code entfernt, der noch mit den Workarounds zusammenhing und nicht mehr benötigt wird.
  * Optimierung.
* Laut [UPGRADING Doc](https://github.com/php/php-src/blob/php-8.4.0RC3/UPGRADING) von PHP 8.4, sollte es mit EMP 2.1.0 keine Probleme geben, daher vorab Maximal-Version von 8.3 auf 8.4 geändert.
* Sprachdateien:
  * 2 Sprachvariablen geändert

#### 2.1.0-b12
* ExtMgr Template:
  * Bei phpBB wird ab 3.3.14 für nicht-installierte Erweiterungen ein neues, separates Template Array erstellt. Im EMP Template wird dieses neue Array jetzt mit dem bisherigen Array für deaktivierte Erweiterungen zusammengeführt, da ansonsten die nicht-installierten Erweiterungen in der Liste fehlen würden.
  * Unnötige `if...endif` Konstrukte durch Ternary (Kurzform) ersetzt.
  * Um besser erkennen zu können welche Elemente zu welcher Spalte gehören, entsprechende Twig Kommentare eingefügt.
* Sprachdateien:
  * Kleine Änderungen.

#### 2.1.0-b11
* ExtMgr Template:
  * Für die Erklärung der "Abhängigkeiten" bei "Reihenfolge & Ignorieren" eine eigene Überschrift hinzugefügt.
  * Kleinere Änderungen.
* phpBB Voraussetzungen geändert: 3.3.0 - 3.3.x -> 3.3.8 - 3.3.x
  * Interne ToDo Funktion mit der Aktionen auf den nächsten Seitenaufbau verschoben werden konnten, wurde vollständig entfernt. Diese Funktion wurde für phpBB Versionen <3.3.8 benötigt und hatte die folgenden Aufgaben gesteuert:
    * Cache löschen
    * Eigendeaktivierung
    * Log-Eintrag
* Core:
  * Code Optimierung.
  * Den bei b8 deaktivierten Code (`trigger_error` Workaround) endgültig entfernt.
* Sprachdateien:
  * 2 Sprachvariablen geändert.
  * 1 Sprachvariable hinzugefügt.
* Migration:
  * Konfig `extmgrplus_exec_todo` wird entfernt.
  * Text-Konfig `extmgrplus_todo` wird entfernt.

#### 2.1.0-b10
* Core:
  * Code Optimierung: 3 `try/catch` Blöcke zu 1 zusammengefasst.
  * Den bei b9 deaktivierten Code endgültig entfernt.

#### 2.1.0-b9
* Beta Fix: Durch die Änderungen bei b8 wurde im ACP beim Speichern einer beliebigen ACP Seite fälschlicherweise das Message Template von EMP für die Bestätigung verwendet.
* Beta Fix: Die bei b8 eingebaute Methode zur kurzfristigen Änderung des Error Handlers hatte zur Folge, dass die Kontrolle wieder an `ext.php` zurückgegeben wurde, was unter Umständen dazu führen konnte, dass nachfolgender Code Aktionen ausgeführt hat, die nicht ausgeführt werden sollen/dürfen. Um das zu lösen, wird jetzt im EMP Error Handler eine eigene Exception erzeugt, wodurch jegliche weitere Ausführung von `ext.php` effektiv verhindert wird. Dadurch ist die Ermittlung der Nachricht auch eleganter, weil dazu keine separate Klassen-Eigenschaft mehr benötigt wird, sondern die Daten von `trigger_error` direkt als Exception Datenpaket übergeben werden können.

#### 2.1.0-b8
* Ein `trigger_error` innerhalb von `ext.php` kann EMP nicht mehr blockieren bzw. nicht mehr zu einem Abbruch einer EMP Aktion führen. Nach sehr langer Zeit habe ich endlich herausgefunden, wie ich das gezielt unterbinden kann. Wollte man z.B. bisher 30 Erweiterungen aktivieren und die 16te würde ein `trigger_error` ausführen, hätte man schlussendlich nur 15 aktivierte Erweiterungen. Mit der neuen Technik hätte man in diesem Fall jedoch 29 aktivierte Erweiterungen und nur 1 nicht aktivierte. Dazu wird das Verhalten des phpBB Error Handlers kurzfristig und lokal begrenzt so geändert, dass die eigentliche Funktion von `trigger_error` komplett deaktiviert wird und die davon erzeugten Daten (4 Werte) in einem Array zwischengespeichert werden, welches dann ausgelesen werden kann. Bei den folgenden Methoden von `ext.php` wird diese Technik ab sofort angewendet:
  * `is_enableable()`
  * `disable_step()`
  * `enable_step()`
* Fehlerbehandlung auf Basis der oben genannten Technik weiter verbessert:
  * Auch beim Deaktivieren werden nun alle nicht erfolgreich geschalteten Erweiterungen explizit aufgelistet. Das war bisher nur beim Aktivieren der Fall. Sollten dabei Nachrichten von `trigger_error` entstehen, werden diese ebenfalls angezeigt.
  * Die fehlgeschlagenen Erweiterungen werden nun nummeriert.
* Die neue Technik um `trigger_error` zu deaktivieren, hatte weitere Änderungen zur Folge, da nun manches nicht mehr benötigt wird:
  * Die Funktion mit der verschiedene Daten zur aktuell bearbeiteten Erweiterung in Template Variablen zwischengespeichert werden mussten, ist nicht mehr nötig und wurde entfernt.
  * Die Funktion mit der eine Nachricht abgefangen und erweitert werden kann (`trigger_error` Workaround), ist nicht mehr nötig und wurde in dieser Form entfernt.
* Core:
  * Code optimiert.
  * VP SIM in eigene Funktion ausgelagert.
* Sprachdateien:
  * 1 Sprachvariable geändert.
  * 1 Sprachvariable hinzugefügt.

#### 2.1.0-b7
* Progress Template:
  * Twig Optimierung.
* Settings Template:
  * Aktuelles Twig Makro `select` von FAR übernommen, mit dem Auswahlmenüs in Templates einfacher und effizienter realisiert werden können. Bei dieser Version muss dem Makro auch nicht mehr separat die Config Variable übergeben werden.
* ACP Controller:
  * PHP Funktion `select_struct` von FAR übernommen, zum Erzeugen einer Select Struktur fürs Template. Ausserdem verbessert um bestehende alte Select Strukturen einfacher auf diese Funktion umstellen zu können.
* PHP Voraussetzungen geändert: 7.1.3 - 8.3.x -> 7.4.0 - 8.3.x
  * 7.4.0: Typisierte Klassen-Eigenschaften.
  * 7.4.0: Verwendung von NCAO.

#### 2.1.0-b6
* Wurde "Details" aufgerufen und es ist zu dem Zeitpunkt noch keine globale Versionsprüfung ausgeführt worden, dann wurde der aktuelle Zeitstempel für die Anzeige der letzten Versionsprüfung gespeichert. Das ist nicht mehr der Fall, der Zeitstempel wird nur noch bei der globalen Versionsprüfung gesetzt.
* Progress Template:
  * Die Fortschrittsanzeige hat jetzt einen zweiten Fortschrittsbalken (blau) oberhalb des bisherigen Fortschrittsbalken, der den ungefähren zeitlichen Fortschritt im aktuellen Block zeigt.
  * Farbe des bisherigen Fortschrittsbalken für die geprüften Erweiterungen von Blau auf Grün geändert, damit beide Balken unterschiedliche Farben haben.
  * Das animierte Icon entfernt, da dieses durch den neuen Fortschrittsbalken nicht länger sinnvoll ist.
* Core:
  * Code optimiert.
* Sprachdateien:
  * 4 neue Sprachvariablen für die zusätzliche Fortschrittsanzeige.
  * 4 Sprachvariablen geändert.

#### 2.1.0-b5
* Beta Fix: Beim neuen Eingabefeld für Sekunden konnte ein Wert ausserhalb von 1-999 gespeichert werden. Ursache war die fehlende Formularprüfung, weil der Absenden-Button nicht als Submit-Element definiert war. [Meldung von Kirk (phpBB.de)]
* Maximaler Wert für Sekunden von 999 auf 99 geändert.

#### 2.1.0-b4
* Beta Fix: Ab 2.1.0-b1 wird der Schalter "Immer auf instabile Entwicklungs-Versionen prüfen" wieder berücksichtigt, das galt jedoch nicht bei der lokalen Versionsprüfung auf der Seite "Details".
* Core:
  * Code optimiert.
* Common:
  * Aktuelle PHP Funktion `set_meta_template_vars()` von LMR übernommen.
* ExtMgr Template:
  * Twig Makro `version()` erweitert, um ein neues Icon (Fragezeichen in orangem Kreis) mit Tooltip anzeigen zu können, bei noch nicht ausgeführter Versionsprüfung.
  * Etliche kleine Struktur-Änderungen.
  * Aktuelles Twig Makro `footer()` von LMR übernommen.
* CSS:
  * Code erweitert für das neue Icon.
* Sprachdateien:
  * 1 neue Sprachvariable für den neuen Tooltip.
  * Kleine Korrekturen.

#### 2.1.0-b3
* Beta Fix: Da EMP ab 2.1.0 bei der Versionsprüfung nicht mehr vom Cache abhängig ist, sondern die Daten direkt in der DB speichert die ermittelt wurden, ergab sich daraus ein neues Problem das dazu führen konnte, dass nach einer VP widersprüchliche Informationen in der Versions-Spalte angezeigt werden konnten. So konnte es vorkommen, das die Version in Grün dargestellt und gleichzeitig ein Fehler Symbol angezeigt wurde. Die Ursache liegt bei phpBB, da vor einer Versionsprüfung der Versions-Cache nicht gelöscht wird und die Rot/Grün Darstellung der bestehenden Version über den Cache gesteuert wird. Um dieses Problem zu beheben, wird jetzt auch dieses Detail über die EMP Daten gesteuert.
* Aus dem Fix ergab sich die Nebenwirkung, dass bei Erweiterungen ohne Updates dauerhaft eine grüne Version dargestellt wird, wie das auch bei phpBB der Fall ist, solange dort der Cache nicht gelöscht wird.
* In der Erweiterungen-Liste wird jetzt in einer neuen Spalte angezeigt, ob die Erweiterung aus der CDB stammt. Als Indikator wird das gleiche Symbol verwendet wie in der Link-Leiste bei "phpBB-Erweiterungsdatenbank".
* Auf der "Details" Seite wird jetzt unten eine neue Gruppe namens "Informationen von Extension Manager Plus" eingefügt, auf der EMP zusätzliche Informationen zur Erweiterung anzeigen kann:
  * Bei Erweiterungen aus der CDB wird jetzt ein Link angezeigt, mit dem man direkt die zugehörige CDB Seite der Erweiterung aufrufen kann.
  * Per neuem Experten-Schalter kann noch ein weiterer Link angezeigt werden, der direkt auf die Versionsdatei verweist.
* Bei der Versionsprüfung wird jetzt auch die gesamte Dauer ermittelt und in der DB gespeichert, damit diese dauerhaft angezeigt werden kann.
* Vor der Ausführung der globalen Versionsprüfung werden jetzt sämtliche im Cache gespeicherten Versionsdaten der Erweiterungen gelöscht. Dadurch wird sichergestellt, das keine veralteten Daten verwendet werden.
* Settings Template:
  * Eine neue Option (Schalter) für den Versionsdatei-Link.
* ExtMgr Template:
  * Eine neue Spalte für das CDB Merkmal eingebaut.
  * VP-Laufzeit in der Info-Tabelle hinzugefügt.
  * Makro `version()` optimiert.
  * Neues Makro `cdb()`.
* Details Template:
  * Für die "Details" Seite das Template `event/acp_ext_details_end.html` hinzugefügt.
* Code optimiert:
  * PHP
  * Twig
* JS:
  * Code für die CDB Spalte angepasst.
  * Code für die Versionsdatei-Option erweitert.
* CSS:
  * Code erweitert für die CDB Spalte.
* Sprachdateien:
  * 3 neue Sprachvariablen für die "Details" Seite.
  * 2 neue Sprachvariablen für die CDB Spalte.
  * 2 neue Sprachvariablen für die Versionsdatei-Option.
  * 1 Sprachvariable angepasst.
* Migration:
  * Neue Config Variable `extmgrplus_switch_version_url`.

#### 2.1.0-b2
* Für die Entscheidung während der VP, ob ein neuer Durchgang gestartet werden muss, wird nicht mehr die Anzahl Erweiterungen berücksichtigt, sondern die Laufzeit des aktuellen Vorganges. Dafür wird die reale Laufzeit von phpBB herangezogen, die zwangsläufig höher liegt als die von EMP selber. Dabei auch den Standardwert von 25 auf 15 geändert, das betrifft:
  * JS (Einstellungen zurücksetzen).
  * Migration.
* Settings Template:
  * Beim neuen Eingabefeld für das VP Limit die Sprachvariable für "Sekunden" hinzugefügt.
* PHP:
  * Code bereinigt.
  * Code optimiert.
* Sprachdateien:
  * 2 Sprachvariablen angepasst.

#### 2.1.0-b1
* (2023-09-05)
* Fix: Im englischen Sprachpaket stimmte bei der Anzeige der Fehler-Anzahl nach einer Versionsprüfung die Plural-Form nicht, wenn die Anzahl exakt `1` betrug. [Meldung von leschek (phpBB.com)]
* EMP steuert jetzt die Versionsprüfung selber und führt diese blockweise aus, wodurch Zeitlimits bei PHP und SQL verhindert werden können. Mit dieser neuen Funktion kann bei phpBB Installationen mit extrem vielen Erweiterungen eine Versionsprüfung erfolgreich ausgeführt werden, bei denen phpBB wegen Zeitlimits nicht in der Lage ist, eine solche vollständig auszuführen. [Meldung von dimassamid (phpBB.com)]
* Settings Template:
  * Eine neue Option (Eingabefeld für eine Zahl) für das VP-Limit hinzugefügt.
* Template:
  * Für die neue Fortschrittsanzeige der VP das Template `acp_ext_mgr_plus_versioncheck.html` hinzugefügt.
* JS:
  * Das neue Eingabefeld bei der Funktion "Einstellungen zurücksetzen" berücksichtigt.
* CSS:
  * Code hinzugefügt für den Fortschrittsbalken.
* Code Optimierung:
  * Anzahl der MySQL Abfragen in der ToDo Funktion reduziert.
* Bei der Version eines Sprachpakets sind jetzt auch Suffixe erlaubt, damit Korrekturen entsprechend signalisiert werden können, zum Beispiel in der Form `2.0.1.1`. Versionen müssen dabei nach den PHP Konventionen gestaltet sein, damit diese per `version_compare()` verglichen werden können.
* Sprachdateien:
  * 2 neue Sprachvariablen für das neue VP-Limit.
  * 1 neue Sprachvariable für den Fortschrittsbalken.
* Migration:
  * Neue Config Variable `extmgrplus_number_vc_limit`.

### 2.0.1
* Release (2024-06-09)

#### 2.0.1-b2
* Core:
  * Rückfrage beim Schalten:
    * Redundanten Code bezüglich `confirm_box` beim Aktivieren/Deaktivieren in einer Closure zusammengefasst.
    * Die unterschiedlichen Erklärungen von phpBB bei Aktivierung/Deaktivierung werden nicht mehr im Core generiert, sondern direkt im Template per Twig geschaltet.
    * Der Hinweis bei Selbstdeaktivierung von EMP wurde ebenfalls in das Template verlagert.
  * Code Optimierung.

#### 2.0.1-b1
* (2024-06-01)
* ExtMgr Template:
  * Die Anzeige der Anleitungen für Installieren, Aktualisieren und Deinstallieren am Ende der Erweiterungen-Liste, kann jetzt deaktiviert werden. [Vorschlag von MattF (phpBB.com)]
* Settings Template:
  * 1 neuer Schalter für die Anleitungen.
* Core:
  * Den neuen Schalter berücksichtigt.
* ACP Controller:
  * Den neuen Schalter berücksichtigt.
* JS:
  * Im IIFE Konstrukt wird jetzt explizit das jQuery Objekt übergeben.
  * Code Optimierung.
  * LukeWCSphpBBConfirmBox 1.4.3
  * Überarbeitete Funktion `setSwitch()` von LFWWH 2.2.0 übernommen.
  * Den neuen Schalter bei der Funktion "Einstellungen zurücksetzen" berücksichtigt.
* CSS:
  * Harmonisierung der Werte-Notation wie bei meinen anderen Erweiterungen:
    * Zahlen kleiner 1 werden mit 0 vor dem Komma definiert.
	* Hexadezimale Werte werden mit Kleinbuchstaben definiert.
* Sprachdateien:
  * 2 neue Sprachvariablen für den neuen Schalter.
* Migration:
  * Neue Config Variable `extmgrplus_switch_instructions`.

### 2.0.0
* Release (2023-12-19)
* Letzter Feinschliff.

#### 2.0.0-b4
* ExtMgr Template:
  * In der Erklärung der Spalte "Reihenfolge" einen Zusatz für die Abhängigkeiten eingefügt.
* Sprachdateien:
  * 1 neue Sprachvariable für die Erklärung der Abhängigkeiten bei Reihenfolge&Ignorieren.
  * 1 Sprachvariable geändert für den Tooltip des Eingabefelds der Reihenfolge-Gruppe.
  * 1 Sprachvariable geändert für den Schalter bez. Reihenfolge&Ignorieren.
* JS:
  * Code bereinigt.
  * Selektoren vereinfacht.
* CSS:
  * Code hinzugefügt damit `<code>` Blöcke besser zu erkennen sind.

#### 2.0.0-b3
* Bei Reihenfolge&Ignorieren können nun auch direkte Abhängigkeiten definiert werden. Dadurch werden beim Auswählen/Abwählen automatisch abhängige Erweiterungen berücksichtigt.
  * ExtMgr Template:
    * In der Spalte "Reihenfolge" ist jetzt auch ein `+` am Anfang erlaubt.
  * JS:
    * Neue Funktion `setCheckboxes` mit der die Beziehungen zwischen Erweiterungen und Abhängigkeiten geprüft und Checkboxen entsprechend gesetzt werden können.
  * Core:
    * Prüfung für die Spalte "Reihenfolge" um `+` erweitert.
	* Beim Aktivieren müssen jetzt Exts aus der Reihenfolge-Liste gefiltert werden, bei denen eine Abhängigkeit  mit `+` definiert wurde.

#### 2.0.0-b2
* ACP Controller umbenannt.
* JS:
  * Unveränderliche Variablen als Konstanten definiert und Scopes präzisiert.

#### 2.0.0-b1
* Um den Versionswechsel auf 2.0 konsistent halten zu können, führe ich die Betas ab sofort mit 2.0.0 weiter und setze den Beta Zähler auf 1 zurück. Das betrifft ebenfalls die Repo Commits.
  * Alle betroffenen Dateien auf 2.0 angepasst.
* Settings Template:
  * Den kleinen Fehler im `switch()` Makro bezüglich Checkboxen und CSS-Klasse korrigiert. Siehe Toggle Control Thema auf phpBB.de.

#### 1.1.3-b26
* Settings Template:
  * Button für Installationsstandard durch `button()` Makro ersetzt.
* JS:
  * Globales Objekt `ExtMgrPlus` entfernt, da durch IIFE nicht mehr benötigt. Stattdessen alle Objekt-Funktionen als normale Funktionen deklariert.
  * Beim JS der Einstellungen mein jQuery Plugin `changeSwitch` durch eine normale Funktion ersetzt, da Plugins global zu jQuery hinzugefügt werden.
* CSS:
  * Durch eine Änderung bei 1.1.3-b19 musste der Reset Button berücksichtigt werden.

#### 1.1.3-b25
* PHP:
  * Anpassungen für phpBB 3.2 entfernt.
* Twig:
  * Anpassungen für phpBB 3.2 entfernt.
* CSS:
  * Da jetzt Schalter auch als Radio-Buttons dargestellt werden können, musste der Pointer für `dd label` wieder aktiviert werden. Das betrifft nicht Reihenfolge&Ignorieren.

#### 1.1.3-b24
* Letzte Version für phpBB 3.2.
* EMP ist jetzt kompatibel mit Toggle Control. Somit können Administratoren zentral an einer Stelle entscheiden, ob für Ja/Nein Schalter Radio Buttons, Checkboxen oder Toggles verwendet werden sollen.
* JS:
  * LukeWCSphpBBConfirmBox 1.4.0:
    * Die Klasse kann jetzt auch mit Radio-Buttons umgehen. Eine manuelle Anpassung ist dabei nicht notwendig, es wird automatisch erkannt welcher Typ (Checkbox oder Radio) bei einem Schalter verwendet wurde. Notwendig für die TC Kompatibilität.
  * Zurücksetzen auf Installationsstandard musste für Radio Buttons erweitert werden. Notwendig für die TC Kompatibilität.
* Settings Template:
  * Das `switch()` Makro wurde erweitert, um auch Checkboxen und Radio Buttons generieren zu können. Notwendig für die TC Kompatibilität.
* CSS:
  * Den Code für die Toggle-Animation auf das Nötigste reduziert.

#### 1.1.3-b23
* CSS:
  * Bei Toggles wird jetzt eine Animation beim Slider verwendet, sowie eine Farb-Animation (Übergang) bei der HG Farbe. [Vorschlag von Kirk (phpBB.de)]
* JS:
  * Code Optimierung.

#### 1.1.3-b22
* Bei EMP ist die Animation für die ConfirmBox ab sofort aktiviert, mit dem Wert 300.
* Settings Template:
  * Kleine Änderung beim ConfirmBox Makro. Die HTML Pendants für `true` und `false` sind jetzt wieder `"1"` und `""`, da dies im JS direkt ohne Konvertierung ausgewertet werden kann.
* JS:
  * LukeWCSphpBBConfirmBox 1.3.0:
    * Redundanten Code zu einer Methode zusammengefasst.
    * Methoden die nur innerhalb der Klasse verwendet werden (für Events), sind jetzt als privat definiert.
    * Optional kann das Öffnen/Schliessen der ConfirmBox-Fenster jetzt als Animation ausgeführt werden. Dazu unterstützt die Klasse einen zweiten Parameter, mit dem die Animation aktiviert und die Geschwindigkeit geregelt werden kann: 400 = Standard, 0 = Aus. [Vorschlag von IMC (phpBB.de)]
    * Code Optimierung.
* Freigegeben für PHP 8.3.

#### 1.1.3-b21
* JS:
  * Das JS für ExtMgr und Settings separiert und die Dateien passend zum Template benannt.
  * Da der Schalter "Immer auf instabile Entwicklungs-Versionen prüfen:" in den Einstellungen nicht zu EMP gehört, wird dieser beim Zurücksetzen auf Standard-Einstellungen nicht mehr berücksichtigt.
* LukeWCSphpBBConfirmBox 1.2.0:
  * Wenn die Klasse mehr als einem Formular pro Template zugeordnet wurde, ergaben sich mehrere Probleme, da die Klasse bisher nicht für mehrere Instanzen ausgelegt war:
    * Fix: Wurde in einem der Formulare eine ConfirmBox geöffnet, dann wurde bei allen Formularen der Absenden-Button deaktiviert.
    * Fix: Wurde in mehreren Formularen eine ConfirmBox geöffnet, dann blieben beim Schliessen eines der ConfirmBox-Fenster die Absenden-Buttons aller Formulare deaktiviert, bis alle ConfirmBox-Fenster in allen Formularen geschlossen wurden.
    * Fix: Wurde in mehreren Formularen eine ConfirmBox geöffnet und dann in einem Formular ein Reset ausgelöst, wurden auch in den anderen Formularen die ConfirmBox-Fenster geschlossen. Der Absenden-Button der anderen Formulare blieb deaktiviert und zwangsläufig wurden auch die geänderten Schalter nicht zurückgesetzt.
* Von EC gemeldete Fehler bei PPSSE und VA behoben.

#### 1.1.3-b20
* Ist Eigendeaktivierung aktiv und es wird beim Deaktivieren der Exts auch EMP mit ausgewählt, dann wird der Workaround bezüglich Cache-löschen nur noch dann ausgeführt, wenn phpBB <3.3.8 vorhanden ist.
* ExtMgr Template: Alle Submit Elemente mit denen das Formular abgeschickt werden kann, befinden sich jetzt gesammelt in einem einzigen Makro.
  * Twig Makro `button()` in `submit_buttons()` integriert.
  * HTML der JS Funktion `ExtMgrPlus.SaveCheckboxes` in `submit_buttons()` integriert.
* JS:
  * HTML für `SaveCheckboxes entfernt und Code daran angepasst.
* CSS:
  * Kleine Korrekturen.

#### 1.1.3-b19
* Fix: Die Enter Taste wird jetzt in den Formularen vom ExtMgr und Einstellungen komplett gesperrt. Bisher wurde die Enter Taste nur in der Spalte Reihenfolge gesperrt, was an mehreren Stellen unterschiedliche Auswirkungen haben konnte:
  * Ist Reihenfolge&Ignorieren aktiviert und man ändert im ExtMgr eine Auswählen-Checkbox und drückt direkt danach Enter, wird die Funktion zum Speichern von Reihenfolge&Ignorieren ausgeführt. Dasselbe gilt auch bei den Checkboxen der Ignorieren-Spalte.
  * Ist Reihenfolge&Ignorieren deaktiviert und man ändert im ExtMgr eine Auswählen-Checkbox und drückt direkt danach Enter, wird die Funktion zum deaktivieren aller Exts ausgeführt, unabhängig davon welche Checkbox zuvor geändert wurde.
* Fix: Regression. Bei b13 wurde der Pointer-Cursor entfernt, aber bei b15 wurde die Änderung unwirksam, weil auf Reihenfolge&Ignorieren begrenzt.
* Settings Template:
  * Der Reset Button hat jetzt wieder seine ursprüngliche, original Reset Funktion.
* LukeWCSphpBBConfirmBox 1.1.0
  * Die Klasse reagiert jetzt direkt auf ein Formular-Reset und schliesst alle geöffneten ConfirmBox-Fenster. Diese Funktionalität muss also nicht mehr separat definiert werden.
  * CSS Code weiter von EMP isoliert.
  * Code optimiert.

#### 1.1.3-b18
* ExtMgr Template:
  * In der Info-Box für die Versionsprüfung wird jetzt hinter dem Text das gleiche animierte Icon angezeigt, wie bei den automatischen Bestätigungen. [Vorschlag von Kirk (phpBB.de)]
* CSS:
  * An das neue Icon angepasst.
* JS:
  * Das Icon für die Versionsprüfung in der Link-Leiste wird nicht mehr animiert.
  * Version der Klasse LukeWCSphpBBConfirmBox auf 1.0.0 gesetzt. Diese Version wird dann auch bei RT und WWH integriert.
* Sprachdateien:
  * Sprachvariable für das neue Icon angepasst.

#### 1.1.3-b17
* JS:
  * Bei einer Versionsprüfung wird nicht mehr die ganze Erweiterungen-Liste ausgeblendet, sondern nur noch die interaktiven Elemente. [Vorschlag von chris1278 (phpBB.de)]
  * Bei Reihenfolge&Ignorieren werden nicht mehr die Spalten mit Aktionen ausgeblendet (siehe 1.1.3-b1), sondern wieder wie früher lediglich die interaktiven Elemente selbst.
  * Code Optimierung.
* ExtMgr Template:
  * Eine Info-Box eingefügt, die darüber informiert, das die Versionsprüfung ausgeführt wird. [Vorschlag von chris1278 (phpBB.de)]
* CSS:
  * Blaue Info-Boxen haben jetzt abgerundete Ecken.
* Sprachdateien:
  * 1 neue Sprachvariable für die neue Info-Box bezüglich Versionsprüfung.

#### 1.1.3-b16
* ExtMgr Template:
  * Die restlichen JS Aufrufe im Template entfernt; Versionsprüfung, Reihenfolge&Ignorieren und Checkbox-Save.
* JS:
  * Die im Template entfernten JS Links als Klick-Events hinzugefügt. Somit werden nun konsequent alle interaktiven Elemente per JS registriert.
  * Bei einer Versionsprüfung werden jetzt alle Funktionen in der Link-Leiste gesperrt und die Erweiterungen-Liste ausgeblendet, um versehentliche Aktionen zu vermeiden.
  * Code der ConfirmBox Klasse optimiert.
* CSS:
  * Code für die neuen JS-Links in der Link-Leiste hinzugefügt.

#### 1.1.3-b15
* JS:
  * Die Inline-ConfirmBox bestehend aus 3 separaten Funktionen und 1 separate Event-Registrierung (für je 3 Controls pro Schalter) zu einer Klasse zusammengefasst. Damit reduziert sich die Projekt-spezifische Integration auf eine einzige Zeile JS Code, bei der die Klasse mittels `new` eingebunden werden kann. Ausserdem ist so der Selektor für den Absenden-Button nicht mehr hardcoded auf 3 Funktionen verteilt, sondern wird nur noch einmal als Klassen-Parameter definiert.
  * Das EMP JS befindet sich jetzt innerhalb einer IIFE Struktur um eine bessere Kapselung zu erreichen.
* CSS:
  * Um die JS Inline-ConfirmBox als eigenständiges Modul gestalten zu können, musste das CSS für EMP strikter definiert werden, damit das CSS für die ConfirmBox isoliert notiert werden konnte.
  * Für die Inline-ConfirmBox die CSS Definition von Thorsten übernommen, die er bei RT eingebaut hat und die für einen dezenten 3D Effekt (Schatten) sorgt.
  * Das Toggle-CSS in das EMP-CSS integriert und die separate Datei entfernt.

#### 1.1.3-b14
* Bei aktivierter Option "Letzten Zustand merken" wird die Auswahl der Kontrollkästchen bei aktivierter Rückfrage nur noch dann gespeichert, wenn die Rückfrage mit "Ja" bestätigt wird. Bei "Nein" wird die zuletzt gespeicherte Auswahl wiederhergestellt.
* CSS:
  * In der Gruppe mit dem Absenden-Button den zu grossen Abstand zwischen Buttons und oberem Rand der Gruppe verkleinert. [Vorschlag von Kirk (phpBB.de)]
  * Datei neu strukturiert.

#### 1.1.3-b13
* CSS; mehrere Kritikpunkte und Vorschläge von Udo berücksichtigt:
  * Für `dd label` waren bei Reihenfolge&Ignorieren unnötige CSS Anweisungen definiert.
  * Für `label` wird jetzt in den Einstellungen und in Reihenfolge&Ignorieren der Pointer-Cursor entfernt, da dieser wegen Toggles keine Relevanz mehr hat.
  * Bei `dd label` wird jetzt beim Hover-Effekt die Textfarbe nicht mehr auf rot geändert.
  * Bei Responsive-Ansicht wird bei Reihenfolge&Ignorieren zwischen beiden Erklärungen eine Trennlinie eingefügt.
  * Die EMP Definition für das Padding bei den Auswählen-Checkboxen entfernt, wodurch wieder die phpBB Definition in Kraft tritt. Dadurch sieht das primär bei Responsive-Ansicht ordentlicher aus.

#### 1.1.3-b12
* ExtMgr Template:
  * Durch die Änderungen von 1.1.3-b9 waren kleine Optimierungen bei Twig möglich, wodurch nicht mehr benötigte Bedingungen entfernt werden konnten.
  * In der Spalten-Überschrift "Name der Erweiterung" war ein unnötiger `<span>` Container sowie eine unbenutzte CSS Klasse definiert. Ursache liegt bei 1.0.0-b8.

#### 1.1.3-b11
* ExtMgr Template:
  * In der Info-Tabelle werden die neuen Anzeigen "(x ungültige)" von 1.1.3-b9 in der ersten Spalte und "(x Fehler)" von 1.1.3-b5 in der dritten Spalte nur noch dann generiert, wenn "x" mindestens 1 beträgt. Dazu wurden pro Spalte 2 Variablen-Positionen innerhalb `lang()` getauscht.
* Sprachdateien:
  * Die bestehenden 2 Sprachvariablen für "Verfügbare Erweiterungen" und "Letzte Versionsprüfung" zu Plural Arrays umgebaut.

#### 1.1.3-b10
* Fix: Wenn bei deaktivierter Rückfrage und aktivierter automatischer Bestätigung Erweiterungen geschaltet wurden und dann die ExtMgr Seite manuell neu geladen wurde (z.B. mit F5), dann führte das beim Firefox dazu, dass fälschlicherweise eine Rückfrage zum erneuten Senden der Formulardaten erschien. Wurde diese Rückfrage positiv bestätigt, dann wurde von EMP die letzte Aktion erneut ausgeführt. Das wiederum konnte zu Fehlern führen, wenn in der Zwischenzeit Änderungen im Dateisystem vorgenommen wurden, durch die Erweiterungen ungültig werden, zum Beispiel Strukturfehler in `composer.json`. Eine neue Funktion rotiert jetzt die GET Parameter der URL bei einer automatischen Weiterleitung, was beim Firefox dazu führt, dass keine Rückfrage mehr bezüglich Formulardaten ausgelöst wird. [Meldung von Kirk (phpBB.de)]
* Fix: Das Problem mit dem erneuten Senden der Formulardaten beim Firefox hatte einen Fehler von EMP aufgedeckt, der dann auftreten konnte, wenn Erweiterungen geschaltet wurden, ohne die ExtMgr Seite vorher neu zu laden. Wenn zwischen zwei Schaltvorgängen eine Erweiterung ungültig wurde, also die Metadaten der Erweiterung nicht mehr gelesen werden konnten, dann führte das zu einem FATAL der nicht abgefangen wurde. [Meldung von Kirk (phpBB.de)]

#### 1.1.3-b9
* Fix: Beim Betatest von 1.1.3 zeigte sich, dass EMP nicht mit ungültigen Erweiterungen umgehen konnte, wodurch sich mehrere Probleme ergaben:
  * In bestimmten Situationen konnte der Zähler für nicht-installierte Erweiterungen in den Minus-Bereich geraten. Da eine negative Anzahl nicht vorgesehen ist, wurde stattdessen die Zahl 18446744073709551615 angezeigt, da in der Sprachvariable ein anderer Variablentyp erwartet wurde. [Meldung von Kirk (phpBB.de)]
  * Bei negativer Anzahl der nicht-installierten Erweiterungen wurden alle deaktivierten Erweiterungen in der Sektion für nicht-installierte Erweiterungen angezeigt. [Meldung von Kirk (phpBB.de)]
  * Die Buttons "Ausgewählte deaktivieren" und "Ausgewählte aktivieren" wurden je nach Situation fälschlicherweise aktiviert.
  * Die Auswahlbox "Alle Erweiterungen auswählen" bei Aktivierte und Deaktivierte wurde je nach Situation fälschlicherweise aktiviert.
  * Die Zähler bei "Aktivierte Erweiterungen" und "Deaktivierte Erweiterungen" wurden je nach Situation falsch berechnet.
  * Bei Reihenfolge&Ignorieren wurden für ungültige Erweiterungen fälschlicherweise Eingabe-Elemente generiert, durch die beim Speichern falsche Daten in die DB geschrieben werden konnten.
* ExtMgr Template:
  * Die Erkennung der nicht-installierten Erweiterungen für die Generierung der Nicht-Installiert-Sektion musste geändert werden, da diese auch auf ungültige Erweiterungen reagiert hat.
  * In der Info-Tabelle wird hinter der Anzahl der verfügbaren Erweiterungen in Klammern auch die Anzahl ungültiger Erweiterungen angezeigt.
  * Bei ungültigen Erweiterungen werden in Reihenfolge&Ignorieren keine Eingabe-Elemente mehr erzeugt.
* Code Optimierung.
* Sprachdateien:
  * 1 neue Sprachvariable für die gemeinsame Anzeige der Anzahl verfügbarer Erweiterungen sowie ungültiger Erweiterungen in der Info-Tabelle.
  * 4 Variablen umbenannt.
  * Kleine Änderungen.

#### 1.1.3-b8
* JS:
  * Die Strikt-Direktive aus den 16 Funktionen entfernt und stattdessen einmal im globalen Namensraum am Anfang der Datei definiert.

#### 1.1.3-b7
* Fix: Fehler in `composer.json` behoben. In der VP war noch eine Debug Änderung vorhanden.
* CSS:
  * Von Udo die geänderte Farbe für das Warn-Icon übernommen.
* Code Optimierung.

#### 1.1.3-b6
* Code Optimierung:
  * Kleine Verbesserungen.
  * Bei lokaler Versionsprüfung (Details) konnte es mehrere Situationen geben, bei denen unnötig der EMP Versions-Cache in der DB aktualisiert wurde. Grund ist die neue Funktion von 1.1.3-b5 zum signalisieren von VP Fehlern.

#### 1.1.3-b5
* Konnte die Versionsprüfung einer Erweiterung nicht erfolgreich ausgeführt werden, wird diese Information jetzt ebenfalls in der DB gespeichert. Das funktioniert sowohl bei der globalen VP (Alle Versionen erneut prüfen), als auch bei der lokalen VP (Details). Somit können nun alle möglichen Zustände (VP erfolgreich/VP fehlerhaft/keine VP eingerichtet) entsprechend signalisiert werden.
* ExtMgr Template:
  * In der Info-Tabelle wird jetzt hinter dem Datum der letzten Versionsprüfung die Anzahl Fehler angezeigt.
  * Bei Erweiterungen bei denen es Fehler bei der Versionsprüfung gab, wird jetzt explizit ein orangefarbenes Warn-Icon mit Tooltip hinter der Version angezeigt.
  * Das Info-Icon `fa-info-circle` für eine fehlende Versionsprüfung war zu allgemein und wurde deshalb zu `fa-chain-broken` geändert. Blaue Farbe wurde entfernt.
* CSS:
  * Farbe für das neue Warn-Icon hinzugefügt.
  * Hilfe-Cursor für alle Icons in der Auswählen-Spalte hinzugefügt.
  * Die Icons mit Tooltips wurden allgemein etwas grösser definiert, damit diese besser erkennbar sind und auch der Hover-Bereich für den Tooltip grösser wird.
* Sprachdateien:
  * 1 neue Sprachvariable für den neuen Fehlerhafte-Versionsprüfung-Tooltip.
  * 1 neue Sprachvariable für die Anzeige von Datum und Anzahl Fehler der Versionsprüfung in der Info-Tabelle.

#### 1.1.3-b4
* ExtMgr Template:
  * Bei veralteten Erweiterung-Versionen wird jetzt für das rote Veraltet-Icon ebenfalls ein Tooltip angezeigt.
  * In der Versions-Spalte waren die Abstände zwischen Text und Icons zu gross. Ursache waren unerwünschte Whitespaces zwischen Text/Icon und HTML Tags. Jetzt sind alle Texte und Icons innerhalb HTML Container und so lassen sich Abstände präzise definieren.
* JS:
  * Die Initialisierung des `ExtMgrPlus` Objekts war nicht Strikt-kompatibel.
* CSS:
  * Hilfe-Cursor für alle Icons in der Version-Spalte hinzugefügt.
* Sprachdateien:
  * 1 neue Sprachvariable für den neuen Veraltete-Version-Tooltip.

#### 1.1.3-b3
* Es wird jetzt bei jeder Erweiterung ermittelt, ob diese eine Versionsprüfung bietet. Wenn nicht, wird das mit einem Indikator entsprechend signalisiert.
* ExtMgr Template:
  * Die Info-Tabelle oberhalb der Erweiterungen-Liste auf 4 Spalten erweitert. Neu ist jetzt die Anzahl der Erweiterungen mit eingerichteter Versionsprüfung.
  * Bei Erweiterungen bei denen keine Versionsprüfung eingerichtet ist, wird jetzt ein blaues Info-Icon mit Tooltip hinter der Version angezeigt.
* CSS:
  * Farbe und Hilfe-Cursor für das neue Info-Icon hinzugefügt.
* Sprachdateien:
  * 1 neue Sprachvariable für die neue Spalte der Info-Tabelle.
  * 1 neue Sprachvariable für den neuen Keine-Versionsprüfung-Tooltip.
  * Kleine Änderungen.

#### 1.1.3-b2
* ExtMgr Template:
  * Wenn eine Erweiterung neue Migrationen hat und die zugehörige Auswahl-Checkbox aufgrund der Einstellungen gesperrt wird, dann wird jetzt ein neuer Tooltip angezeigt, der erklärt, warum die Checkbox gesperrt ist.
  * Um den neuen Tooltip zu ermöglichen ohne zuviel umbauen zu müssen, wird die EMP Auswahl-Checkbox - abhängig von den Einstellungen - ab sofort nicht mehr deaktiviert, sondern gar nicht erst erzeugt. Damit verhält sich die EMP Auswahl-Checkbox genauso wie bei Reihenfolge&Ignorieren, wo für EMP ebenfalls keine Eingabe-Elemente erzeugt werden.
* Sprachdateien:
  * 1 neue Sprachvariable für den neuen Gesperrt-Tooltip.

#### 1.1.3-b1
* (2023-09-17)
* Fix: Bei der Ermittlung neuer Migrationen verhinderte eine zu strikte Dateinamen-Prüfung eine korrekte Erkennung, wenn bei Dateinamen und Klassennamen abweichende Gross/Kleinschreibung verwendet wurde. Daraus ergaben sich 2 Fehler:
  * Bei aktivierter Anzeige der Spalte für neue Migrationen wurde die Anzahl falsch berechnet.
  * Bei deaktiviertem Sicherheitsschalter für neue Migrationen wurde die Auswahl-Checkbox der betroffenen Erweiterung nicht gesperrt.
* ExtMgr Template:
  * Reihenfolge&Ignorieren: Beim Einblenden der Einstellungen werden jetzt diejenigen Spalten komplett ausgeblendet, die irrelevante interaktive Elemente enthalten, anstatt nur die Elemente auszublenden.
  * Reihenfolge&Ignorieren: Ist die Funktion deaktiviert, wird jetzt auch kein HTML mehr generiert für die Erklärungstexte, für den Absenden-Block sowie für die Inhalte der Spalten Reihenfolge und Ignorieren.
  * Ein Makro für zukünftige Funktionen vorbereitet.
* JS:
  * An die Änderungen von Reihenfolge&Ignorieren angepasst.
  * Die Funktion zum sperren der Enter-Taste wird nicht mehr separat registriert, sondern innerhalb der `ready()` Funktion per `on()` Event, wie alle anderen Ereignisse. Die jQuery Funktion `keypress()` ist ohnehin als DEPRECATED eingestuft.
  * Bei den Tastendruck-Ereignissen ist die Eigenschaft `keyCode` (ebenfalls `which`) als DEPRECATED eingestuft und wurde auf das neue `key` umgestellt.
  * Die Enter-Taste wird innerhalb des `extmgrplus_list` Formulars nicht mehr generell gesperrt, sondern nur noch im Eingabefeld für die Reihenfolge-Gruppe. Das dient als Vorbereitung für zukünftige Funktionen.
  * Code Optimierung.
* Sprachdateien:
  * Durch eine Änderung in 1.0.7 wurde eine Sprachvariable obsolet, diese wurde jedoch bisher nicht entfernt.
* `composer.json`:
  * Von Tabs auf Spaces umgestellt. Basiert auf dem EditorConfig Standard v1.2 von phpBB.de.

### 1.1.2
* Release (2023-06-06)

#### 1.1.2-b4
* Fix: Das neue Ignorieren-Icon wurde unter phpBB 3.2 nicht angezeigt, weil innerhalb Makros weitere Makros nur aufgerufen werden können, wenn diese vorher importiert wurden. Gleiches Problem wie bei 1.1.1-b7. Da aber jetzt in 3 Makros ein Icon benötigt wird, musste eine andere Lösung gefunden werden.
* ExtMgr Template:
  * Eine unnötige Klasse in der Migrationen-Spalte entfernt. Die Elemente werden jetzt per direktem Spalten-Selektor angesprochen.
* CSS:
  * Code für Migrationen-Spalte hinzugefügt.
* Sprachdateien:
  * Kleine Änderung im Ignoriert-Tooltip, damit unmissverständlich klar ist, dass sich der Ignoriert-Status einer Erweiterung nur auf EMP bezieht.

#### 1.1.2-b3
* Validierungs-Kritik 1.1.1:
  * Bei Versions-Anzeigen kann das Präfix "v" jetzt per Sprachvariable global angepasst werden. Das betrifft auch das Makro Template mit dem Footer.
* Das Ignoriert-Icon in der Auswählen-Spalte grösser definiert. [Vorschlag von Kirk (phpBB.de)]
* In der Tabellen-Überschrift alle Icons etwas grösser definiert und den Standard `font-weight: bold;` entfernt, wodurch die Icons nicht länger unscharf wirken.
* Sprachdateien:
  * 1 neue Sprachvariable für den Versions-String.
  * Sprach-Version erhöht.
* CSS:
  * Geänderten Code für die Icons.
* `composer.json`:
  * Sprach-Mindestversion erhöht.

#### 1.1.2-b2
* Ignorierte Exts sind jetzt auch bei der Migrationsprüfung ausgeschlossen. In dem Fall wird das Ignorieren-Icon angezeigt, statt der Migrationen.
* Bei ignorierten Exts wird statt einer deaktivierten Checkbox jetzt ebenfalls das Ignorieren-Icon angezeigt.
* Sprachdateien:
 * 1 neue Sprachvariable für den Ignoriert-Tooltip.

#### 1.1.2-b1
* Fix: Ursache für die Debug Warnung `Undefined array key` behoben, wenn Dateien im Ordner `migrations` kein Suffix haben.
* Fix: Debug Meldungen die während einer Versionsprüfung entstehen können, wurden durch eine Änderung in 1.1.1 unterdrückt.

### 1.1.1
* Release (2023-05-18)
* `composer.json`:
  * EMP Versionsprüfung von github.io auf phpbb.com geändert.

#### 1.1.1-b10
* JS:
  * URL für Versionsprüfung wird jetzt direkt vom Template an die Funktion per Parameter übergeben.
  * Bei den Links für Versionsprüfung und Checkboxen-speichern wird nicht mehr abgefragt ob Reihenfolge&Ignorieren geöffnet ist, sondern ob der jeweilige Link die CSS Klasse `disabled` hat.
* ExtMgr Template:
  * Javascript für Datenübergabe entfernt, da nicht länger benötigt.
* Core:
  * Code Optimierung.

#### 1.1.1-b9
* Fix: In 1.1.1-b5 hat sich ein Fehler im CSS eingeschlichen, durch den in der Responsive-Ansicht der Einstellungen zwischen Beschreibung und Konfig-Element kein Abstand mehr erzeugt wurde.
* JS:
  * Die Funktion zum Abblenden der Reihenfolge-Textfelder setzt nicht mehr direkt eine CSS Eigenschaft (`opacity`), sondern setzt/entfernt lediglich eine CSS Klasse. Damit verhält sich JS genauso wie Twig, da diese Eigenschaft je nach Einstellung auch vom Template mittels CSS Klasse gesetzt wird.

#### 1.1.1-b8
* Mit einem neuen Schalter kann festgelegt werden, ob positive Meldungen automatisch bestätigt werden sollen. Dabei wird automatisch nach 1 Sekunde zum Link weitergeleitet, der unterhalb jeder Meldung anklickbar ist. Das genügt um die grüne Box als Rückmeldung wahrnehmen zu können. Fehlermeldungen sind von diesem Schalter nicht betroffen und müssen weiterhin manuell bestätigt werden.
* Settings Template:
  * Neuen Schalter "Meldungen automatisch bestätigen" hinzugefügt.
* `trigger_error` Template:
  * Ein animiertes FA Icon eingebaut das nur dann unterhalb einer Meldung angezeigt wird, wenn diese positiv ist und wenn die automatische Bestätigung aktiviert ist.
* ExtMgr Template:
  * Unnötige ID der Link-Leiste Icons entfernt.
* Core:
  * Wrapper Funktion für `trigger_error` eingebaut um redundanten Code im Core und Controller zu vermeiden. Ausserdem um die Generierung der Meldungen zentral an einer Stelle regeln zu können.
* Migration:
  * Neue Config-Variable `extmgrplus_switch_auto_redirect` hinzugefügt.
* Sprachdateien:
  * 2 neue Sprachvariablen für den neuen Schalter hinzugefügt.
* CSS:
  * Code für das neue Icon hinzugefügt.
  * Code für die Link-Leiste Icons geändert.

#### 1.1.1-b7
* Fix: Unter phpBB 3.2 wurde ab EMP 1.1.1-b4 bei veralteten Erweiterung-Versionen das FA Icon (Ausrufezeichen in rotem Kreis) nicht mehr angezeigt. Die Ursache liegt bei Twig 1: Makros sind nicht automatisch innerhalb Makros verfügbar und müssen umständlich importiert werden. Im Versions-Makro den Aufruf für das Icon-Makro entfernt und HTML direkt notiert.

#### 1.1.1-b6
* Die Funktion zum ermitteln der Versionsnummer des Sprachpakets sowohl strikter als auch flexibler gestaltet.
  * Strikter: Der Versions-String muss auf jeden Fall mit dem Muster x.y.z beginnen. Bisher wurde nicht geprüft, ob die Versionsnummer 3 Segmente hat.
  * Flexibler: Hinter einer gültigen Version dürfen Zusätze verwendet werden, wie z.B. ein viertes Segment oder ein Suffix.
* Settings Template:
  * Kleine Änderungen.

#### 1.1.1-b5
* Settings Template:
  * Der Schalter bez. instabiler Versionen wird jetzt ebenfalls von der Funktion zum Zurücksetzen auf Installation-Standard berücksichtigt.
  * Die Rückfragen erfolgen nicht mehr per modalem Javascript Dialog `confirm()`, sondern per HTML und CSS. Dadurch wird Javascript nicht mehr angehalten und die Rückfrage öffnet und schliesst verzögerungsfrei. Dazu wird direkt unter dem betreffenden Schalter ein entsprechender Dialog eingeblendet. Die Dialog-Funktion wurde so konzipiert, dass für eine Rückfrage lediglich der entsprechende Makro-Aufruf im Template eingefügt werden muss. Um alles Weitere kümmert sich Javascript dann selbständig, zum Beispiel die Registrierung aller benötigten onChange und onClick Events.
  * Nicht mehr benötigten Code für `confirm()` entfernt.
* JS:
  * Neue Funktionen für den Inline-Dialog hinzugefügt.
  * Nicht mehr benötigten Code für `confirm()` entfernt.

#### 1.1.1-b4
* Für die Einstellungen gibt es jetzt ein eigenes ACP Modul.
  * Moduldateien hinzugefügt.
  * ACP Template hinzugefügt.
  * Controller hinzugefügt.
  * Die Rückfrage bez. instabiler Versionen wird jetzt ebenfalls mit JS geregelt.
* ExtMgr Template:
  * HTML, Twig und JS für die Einstellungen entfernt.
  * Bei Reihenfolge & Ignorieren wird der Submit-Button jetzt per Makro erzeugt.
* HTML:
  * Der Footer wird nicht länger als HTML Datei inkludiert und wurde entfernt.
* Twig:
  * Allgemeine Funktionen werden jetzt über eine separate Makro Datei inkludiert. Wurde durch das neue ACP Template sinnvoll, um redundanten Twig Code zu vermeiden, der in beiden Templates benötigt wird.
  * Makro für den Footer hinzugefügt.
  * Code für die Link-Leiste kompakter gestaltet durch Ternary's.
* Core:
  * Neue Datei `ext_mgr_plus_common.php` angelegt, um redundanten PHP Code zu vermeiden, der sowohl im ExtMgr Core als auch im Settings Controller benötigt wird.
* JS:
  * Die Funktion für Ein/Ausblenden der Einstellungen entfernt.
  * Die Funktion für Bestätigung eines Schalters ist jetzt universell gestaltet, wodurch die Funktion für beliebige Schalter genutzt werden kann.
  * Wenn Reihenfolge & Ignorieren geöffnet ist, wird jetzt der Link für die Versionsprüfung ebenfalls deaktiviert.
* Migration:
  * Neue Migration für das Hinzufügen des ACP Moduls.
* Sprachdateien:
  * Variablen für ExtMgr und ACP Modul auf 2 Dateien aufgeteilt. Somit wird nur noch geladen, was auch jeweils benötigt wird.
  * 2 neue Variablen für das ACP Modul hinzugefügt.
  * 1 neue Datei hinzugefügt in der nur die Daten des Übersetzers definiert sind sowie die Meldung bezüglich veraltetem Sprachpaket.
  * Kleine Änderungen.

#### 1.1.1-b3
* Core:
  * Die Funktion zum Abfangen von `trigger_error` Meldungen so geändert, dass das Standard Template von phpBB durch ein EMP Template ersetzt wird.
  * Alle `trigger_error` Aufrufe werden jetzt so vorbereitet, dass für die Meldung stets das neue EMP Template genutzt wird.
  * Code so geändert, das Anzeigename und Version von EMP universell überall angezeigt werden können. Dadurch entfiel auch redundanter Code.
  * Beim Select-Array für den Checkbox-Modus Wert und Sprachvariable getauscht.
* ExtMgr Template:
  * Beim Select-Array für den Checkbox-Modus Wert und Sprachvariable getauscht.
  * Kleine Änderungen
* TriggerError Template:
  * Für `trigger_error` eigenes Template hinzugefügt. Das Template basiert auf dem Original von phpBB und wurde so erweitert, dass bei allen Meldungen der ExtMgr Titel, die ExtMgr Beschreibung, die jeweilige Aktions-Erklärung (sofern zutreffend) sowie der EMP Footer angezeigt wird. Damit verhält sich EMP auch bei Bestätigungen wie phpBB, da Meldungen stets in das ExtMgr Template Gerüst eingebettet sind.
* Sprachdateien:
  * In 6 Sprachvariablen den einleitenden Text "ExtMgrPlus:" für Meldungen entfernt, da dieser durch das neue TriggerError Template nicht mehr benötigt wird.
  * 2 neue Sprachvariablen für die Überschriften von "Aktivierte" und "Deaktivierte" hinzugefügt, bei der die Anzahl jetzt per Platzhalter in der Sprachvariable eingefügt wird.
  * 1 Sprachvariable für die Überschrift von "Nicht installierte" geändert, bei der die Anzahl jetzt per Platzhalter in der Sprachvariable eingefügt wird.
  * Kleine Änderungen

#### 1.1.1-b2
* ConfirmBox Template:
  * HTML Tag Fehler in `acp_ext_mgr_plus_confirm_body.html` korrigiert. [Meldung von IMC (phpBB.de)]
  * Restliche veraltete Template Syntax durch Twig ersetzt.
* Prüfung auf gültige Migration verbessert durch 2 neue Bedingungen:
  * Suffix der Datei muss dem Serverseitig eingestellten PHP Suffix entsprechen.
  * Der deklarierte Klassenname innerhalb der Migrationsdatei muss exakt dem Dateinamen entsprechen.
* Core:
  * Code Optimierung.
* `services.yml` erweitert.

#### 1.1.1-b1
* ExtMgr Template:
  * Icon von `fa-wifi` auf `fa-refresh` geändert. Während der Versionsprüfung wird dieses Icon jetzt animiert.
  * Die URL der Versionsprüfung wird nicht mehr direkt aufgerufen, sondern an eine neue JS Funktion übergeben.
* JS:
  * Funktion hinzugefügt um die Versionsprüfung starten und das zugehörige Icon animieren zu können.
* Core:
  * Nach der Ausführung der Versionsprüfung erfolgt ein Redirect auf die normale URL der "Erweiterungen verwalten" Seite. Dadurch wird verhindert, dass nach einer Versionsprüfung durch Neuladen der Seite erneut eine Versionsprüfung ausgeführt wird.
* CSS:
  * Wenn der Speichern-Link für Checkboxen deaktiviert ist, verhält er sich jetzt vollständig wie ein deaktiviertes Element, hat also keinerlei Hover-Effekte mehr. Ebenso wird jetzt die Link-Farbe entfernt.
  * Optimierung. 1) Mehrere Eigenschaften neu gruppiert. 2) Mehrere Selektoren anders definiert, um diese reduzieren zu können.

### 1.1.0
* Release (2023-02-24)
* Core:
  * Bei der Prüfung der Bedingungen für die Speicherung der Checkboxen wird jetzt auch "Letzten Zustand merken" berücksichtigt.
* Sprachdateien:
  * In der Erklärung von "Kontrollkästchen setzen" wird das FA Checkbox Icon jetzt per Platzhalter in der Sprachvariable eingefügt.
  * Bei den Erklärungen für "Reihenfolge" und "Ignorieren" wird das FA Icon jetzt ebenfalls per Platzhalter in der Sprachvariable eingefügt.

#### 1.1.0-b11
* Core:
  * Bei der Auswertung von `is_enableable` wird jetzt strikt nach phpBB Version unterschieden. Unverändert muss bei >=3.3.0 ein explizites `true` zurückgegeben werden, damit eine Erweiterung aktiviert werden kann. Bei <3.3.0 genügt jetzt auch ein implizites `true`.
  * Mehrere Template-Variablen umbenannt.
  * Code Optimierung.
* ExtMgr Template:
  * An umbenannte Template-Variablen angepasst.
  * Twig optimiert.
  * Icons der Link-Leiste werden beim überfahren nicht mehr unterstrichen und verhalten sich damit wie die Icons der Schnellzugriff-Leiste. Ausserdem Icons etwas grösser definiert.

#### 1.1.0-b10
* Migration geändert, vorherige Betas müssen deinstalliert werden.
  * Alle `config` und `config_text` Variablen umbenannt.
* Core:
  * An umbenannte Config-Variablen angepasst.
  * Code Optimierung.
* ExtMgr Template:
  * Die Link-Leiste so gestaltet wie die Schnellzugriff-Leiste im Forenindex mit individuellen Icons für jede Aktion.
  * An umbenannte Config-Variablen angepasst.
* JS:
  * Der Checkbox-Save Link wird jetzt deaktiviert, wenn eine der Einstellungsgruppen geöffnet ist.
  * An umbenannte Config-Variablen angepasst.
* Sprachdateien:
  * 2 Variablen geändert.

#### 1.1.0-b9
* Ist "Letzten Zustand merken" aktiv, kann jetzt jederzeit die aktuelle Checkbox-Auswahl gespeichert werden, unabhängig von Deaktivieren/Aktivieren.
* ExtMgr Template:
  * Oben rechts ein Link eingefügt, mit dem die aktuelle Checkbox-Auswahl gespeichert werden kann. Der Zustand des Links ist von "Letzten Zustand merken" abhängig.
* JS:
  * Neue Funktion für das Speichern der Checkboxen hinzugefügt. Damit wird ein spezifischer Submit-Button innerhalb eines Formulars simuliert, indem dynamisch eine `hidden` Eigenschaft zum DOM hinzugefügt wird. Dieser Kniff ist nötig, da sich das aufrufende Element ausserhalb des Formulars befindet und zudem ein normaler Link ist, kein Submit-Button.
* Sprachdateien:
  * Für die neue Checkbox-Save Funktion 2 Variablen hinzugefügt und 2 Variablen geändert.

#### 1.1.0-b8
* Neue Eigenschaft für Checkboxen: Letzten Zustand merken.
* ExtMgr Template:
  * Schalter für Checkboxen durch Optionsliste ersetzt.
  * Neues Twig Makro `select` um simpel Optionslisten einfügen zu können.
  * Template an die Änderungen der Checkbox Handhabung angepasst.
  * JS Defaults Funktion für neue Optionsliste angepasst.
* Sprachdateien:
  * Für die neue Checkboxen Eigenschaft 3 Variablen hinzugefügt und 1 Variable geändert.
  * 2 Variablen umbenannt.
* Migration:
  * Neue Config Variable `extmgrplus_enable_checkbox_mode`.
  * Config Variable `extmgrplus_enable_checkboxes_all_set` entfernt.

#### 1.1.0-b7
* Core:
  * Variablen umbenannt.
* ExtMgr Template:
  * Variablen umbenannt.
  * Twig Makro für FA Icons von `<span>` auf `<i>` geändert, was wieder phpBB Standard entspricht.
* CSS:
  * Nicht mehr benötigtes CSS entfernt.

#### 1.1.0-b6
* Core und ExtMgr Template: Eine unnötige Template Variable entfernt, da hierfür bereits eine Config Template Variable existiert.
* Die maximale PHP Laufzeit wird nicht mehr direkt aus der PHP INI geladen, sondern aus dem Event Datenpaket ermittelt.
* Reihenfolge & Ignorieren:
  * Die Beschreibungen von Reihenfolge und Ignorieren werden jetzt nebeneinander statt untereinander dargestellt. [Vorschlag von Kirk (phpBB.de)]
  * Unterhalb der Erweiterungen-Liste wird jetzt ebenfalls ein Absenden-Button eingefügt. [Vorschlag von Kirk (phpBB.de)]
* Sprachdateien:
  * Meldungen bezüglich Überschreitung der maximalen PHP Laufzeit vereinfacht.
  * Für "Reihenfolge & Ignorieren" 2 Variablen hinzugefügt und 2 Variablen geändert.
* CSS:
  * Nicht mehr benötigtes CSS entfernt.
  * Mehrere neue Gruppen für Reihenfolge & Ignorieren hinzugefügt.

#### 1.1.0-b5
* Code Optimierung:
  * Anzahl MySQL Abfragen weiter reduziert: Zugriff auf ToDo Array (`config_text`) erfolgt nur noch dann, wenn entsprechende `config` Variable gesetzt ist.
  * Kleine Verbesserungen.
* Migration: Neue Config Variable `extmgrplus_exec_todo`.
* Versionsweiche beim Cache Workaround auf 3.3.8-rc1 präzisiert.

#### 1.1.0-b4
* ConfirmBox Template:
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
* ExtMgr Template:
  * Formale Fehler behoben.

#### 1.1.0-b1
* Spalte "Neue Migrationsdateien":
  * Die Anzahl wird jetzt auch bei nicht installierten Erweiterungen angezeigt.
  * Die Spalte "Neue Migrationsdateien" kann jetzt ein/ausgeschaltet werden. Standard ist ausgeschaltet.
* Zum ermitteln der neuen Migrationsdateien wird nicht mehr die Migrator Klasse verwendet, sondern eigene Funktionen.
* In Fehlermeldungen wird jetzt zusätzlich die Version der betreffenden Erweiterung angezeigt.
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
* Release (2023-02-01)
* ConfirmBox Template
  * Bei den Aktionen "Ausgewählte deaktivieren" und "Ausgewählte aktivieren" wird jetzt oberhalb der Rückfrage der gleiche Hinweis angezeigt, den auch phpBB selbst bei der Rückfrage der Aktionen "Deaktivieren" und "Aktivieren" anzeigt.
* Sprachdateien:
  * Texte bezüglich "Migrationen erlauben" präzisiert.
* ExtMgr Template:
  * Richtlinienfehler behoben. [Meldung von Kirk (phpBB.de)]
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
* ExtMgr Template:
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
* Release (2022-12-04)
* Code Optimierung:
  * Die Funktion `catch_message()` wird jetzt frühzeitig abgebrochen, wenn sie nicht benötigt wird. Dadurch werden bei allen Seitenaufrufen im ACP 5 Funktionsaufrufe und 4 Bedingungen eingespart.

#### 1.0.7-b8
* Im Header werden die Infos (Gesamtzahl, Versionsprüfung) nicht mehr in einer Blind-Tabelle dargestellt, sondern in einer phpBB Standard Tabelle.
  * CSS der Blind-Tabelle entfernt.

#### 1.0.7-b7
* Die Prüfung auf Überschreitung der maximalen Ausführungszeit findet nur noch statt, nachdem eine Erweiterung geschaltet wurde. Bisher wurde auch innerhalb `enable_step()` geprüft.
* Die Prüfung auf Überschreitung der maximalen Ausführungszeit findet nicht mehr vor dem Log Eintrag statt, sondern danach. So kann der Log Eintrag vor Abbruch noch aktualisiert werden.
* ConfirmBox Template:
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
* ExtMgr Template:
  * Toggle CSS optimiert und in separate Datei ausgelagert.

#### 1.0.7-b4
* ExtMgr Template:
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
* ExtMgr Template:
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
* Release (2022-11-05)
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
* Release (2022-10-29)
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
* Release (2023-08-10)

#### 1.0.4-b1
* Fix für "Berechtigungen des Benutzers testen".

### 1.0.3
* Release (2022-06-24)
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
* Release (2022-06-17)
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
* Bei der Prüfung ob eine Erweiterung aktiviert werden kann mittels `is_enableable()` (`ext.php`), wird jetzt auch ein String und ein Array als möglicher Rückgabewert akzeptiert und entsprechend aufbereitet. Diese Methode der Fehlerbehandlung wurde erst in phpBB 3.3.0 eingeführt und kann `trigger_error` ersetzen. [Hinweis von IMC (phpBB.de)]

### 1.0.1
* Release (2023-06-12)

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
* Release (2022-06-08)
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
* Fix: Wenn Migrationen deaktiviert sind und bei Exts mit neuen Migrationsdateien zusätzlich noch das Ignorieren-Merkmal gesetzt wird, dann konnte es vorkommen, das die Alle-Deaktivieren Checkbox deaktiviert wird, obwohl es noch schaltbare Exts gab. Der Grund lag in der falschen Berechnung der schaltbaren Exts. [Meldung von Kirk (phpBB.de)]

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
  * In der Responsive-Ansicht wird bei geöffneten Einstellungen der Button "Spalte speichern" zentriert, damit dieser optisch zu den anderen Buttons passt. [Vorschlag von Kirk (phpBB.de)]
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
  * Bei der Option "Erlaube Migrationen" erfolgt jetzt eine Rückfrage per JS Popup die mit OK bestätigt werden muss. Ansonsten wird die Option wieder auf "Nein" zurückgestellt. [Vorschlag von Scanialady (phpBB.de), chris1278 (phpBB.de)]
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
* Fix: In der Spalte für Reihenfolge/Ignorieren konnten keine 2-stelligen Werte eingetragen werden. Im HTML wurde schlicht das RegEx für die Eingabeprüfung falsch definiert. [Meldung von Kirk (phpBB.de)]
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
  * Es gibt jetzt einen neuen Schalter mit dem man festlegen kann, ob die Checkboxen standardmässig alle gesetzt sind oder nicht. [Vorschlag von Kirk (phpBB.de)]
  * Etliche Anpassungen für die Checkbox Option.
* Statt zwei Einstellungen-Links gibt es nur noch einen. Mit diesem Link werden also gleichzeitig beide Formulare von phpBB und ExtMgrPlus angezeigt oder ausgeblendet. [Vorschlag von Scanialady (phpBB.de)]
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
* Durch die neue Methode der ErrorBox Handhabung, wurde es nun möglich, die Eigendeaktivierung als Option einzubauen. [Vorschlag von 69bruno (phpBB.de)]
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
  * Die Anzahl der neuen Migrationsdateien wird jetzt nicht mehr in der Spalte der Erweiterung-Namen angezeigt, sondern in einer neuen Spalte.
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
