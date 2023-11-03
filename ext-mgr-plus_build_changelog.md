### 1.1.3-b19
* Fix: Die Enter Taste wird jetzt in den Formularen vom ExtMgr und Einstellungen komplett gesperrt. Bisher wurde die Enter Taste nur in der Spalte Reihenfolge gesperrt, was an mehreren Stellen unterschiedliche Auswirkungen haben konnte:
  * Ist Reihenfolge&Ignorieren aktiviert und man ändert im ExtMgr eine Auswählen-Checkbox und drückt direkt danach Enter, wird die Funktion zum Speichern von Reihenfolge&Ignorieren ausgeführt. Dasselbe gilt auch bei den Checkboxen der Ignorieren-Spalte.
  * Ist Reihenfolge&Ignorieren deaktiviert und man ändert im ExtMgr eine Auswählen-Checkbox und drückt direkt danach Enter, wird die Funktion zum deaktivieren aller Exts ausgeführt, unabhängig davon welche Checkbox zuvor geändert wurde.
* Fix: Regression. Bei b13 wurde der Pointer-Cursor entfernt, aber bei b15 wurde die Änderung unwirksam, weil auf Reihenfolge&Ignorieren begrenzt.
* LukeWCSphpBBConfirmBox 1.1.0
  * Die Klasse reagiert jetzt direkt auf ein Formular-Reset und schliesst alle geöffneten ConfirmBox-Fenster. Diese Funktionalität muss also nicht mehr separat definiert werden.
  * CSS Code weiter von EMP isoliert.
  * Code optimiert.
 
### 1.1.3-b18
* ExtMgr Template:
  * In der Info-Box für die Versionsprüfung wird jetzt hinter dem Text das gleiche animierte Icon angezeigt, wie bei den automatischen Bestätigungen. [Vorschlag von Kirk (phpBB.de)] 
* CSS:
  * An das neue Icon angepasst.
* JS:
  * Das Icon für die Versionsprüfung in der Link-Leiste wird nicht mehr animiert.
  * Version der Klasse LukeWCSphpBBConfirmBox auf 1.0.0 gesetzt. Diese Version wird dann auch bei RT und WWH integriert.
* Sprachdateien:
  * Sprachvariable für das neue Icon angepasst.

### 1.1.3-b17
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

### 1.1.3-b16
* ExtMgr Template:
  * Die restlichen JS Aufrufe im Template entfernt; Versionsprüfung, Reihenfolge&Ignorieren und Checkbox-Save.
* JS:
  * Die im Template entfernten JS Links als Klick-Events hinzugefügt. Somit werden nun konsequent alle interaktiven Elemente per JS registriert.
  * Bei einer Versionsprüfung werden jetzt alle Funktionen in der Link-Leiste gesperrt und die Erweiterungen-Liste ausgeblendet, um versehentliche Aktionen zu vermeiden.
  * Code der ConfirmBox Klasse optimiert.
* CSS:
  * Code für die neuen JS-Links in der Link-Leiste hinzugefügt.

### 1.1.3-b15
* JS:
  * Die Inline-ConfirmBox bestehend aus 3 separaten Funktionen und 1 separate Event-Registrierung (für je 3 Controls pro Schalter) zu einer Klasse zusammengefasst. Damit reduziert sich die Projekt-spezifische Integration auf eine einzige Zeile JS Code, bei der die Klasse mittels `new` eingebunden werden kann. Ausserdem ist so der Selektor für den Absenden-Button nicht mehr hardcoded auf 3 Funktionen verteilt, sondern wird nur noch einmal als Klassen-Parameter definiert.
  * Das EMP JS befindet sich jetzt innerhalb einer IIFE Struktur um eine bessere Kapselung zu erreichen.
* CSS:
  * Um die JS Inline-ConfirmBox als eigenständiges Modul gestalten zu können, musste das CSS für EMP strikter definiert werden, damit das CSS für die ConfirmBox isoliert notiert werden konnte.
  * Für die Inline-ConfirmBox die CSS Definition von Thorsten übernommen, die er bei RT eingebaut hat und die für einen dezenten 3D Effekt (Schatten) sorgt.
  * Das Toggle-CSS in das EMP-CSS integriert und die separate Datei entfernt.

### 1.1.3-b14
* Bei aktivierter Option "Letzten Zustand merken" wird die Auswahl der Kontrollkästchen bei aktivierter Rückfrage nur noch dann gespeichert, wenn die Rückfrage mit "Ja" bestätigt wird. Bei "Nein" wird die zuletzt gespeicherte Auswahl wiederhergestellt.
* CSS:
  * In der Gruppe mit dem Absenden-Button den zu grossen Abstand zwischen Buttons und oberem Rand der Gruppe verkleinert. [Vorschlag von Kirk (phpBB.de)]
  * Datei neu strukturiert.

### 1.1.3-b13
* CSS; mehrere Kritikpunkte und Vorschläge von Udo berücksichtigt:
  * Für `dd label` waren bei Reihenfolge&Ignorieren unnötige CSS Anweisungen definiert.
  * Für `label` wird jetzt in den Einstellungen und in Reihenfolge&Ignorieren der Pointer-Cursor entfernt, da dieser wegen Toggles keine Relevanz mehr hat.
  * Bei `dd label` wird jetzt beim Hover-Effekt die Textfarbe nicht mehr auf rot geändert.
  * Bei Responsive-Ansicht wird bei Reihenfolge&Ignorieren zwischen beiden Erklärungen eine Trennlinie eingefügt.
  * Die EMP Definition für das Padding bei den Auswählen-Checkboxen entfernt, wodurch wieder die phpBB Definition in Kraft tritt. Dadurch sieht das primär bei Responsive-Ansicht ordentlicher aus.

### 1.1.3-b12
* ExtMgr Template:
  * Durch die Änderungen von 1.1.3-b9 waren kleine Optimierungen bei Twig möglich, wodurch nicht mehr benötigte Bedingungen entfernt werden konnten.
  * In der Spalten-Überschrift "Name der Erweiterung" war ein unnötiger `<span>` Container sowie eine unbenutzte CSS Klasse definiert. Ursache liegt bei 1.0.0-b8.

### 1.1.3-b11
* ExtMgr Template:
  * In der Info-Tabelle werden die neuen Anzeigen "(x ungültige)" von 1.1.3-b9 in der ersten Spalte und "(x Fehler)" von 1.1.3-b5 in der dritten Spalte nur noch dann generiert, wenn "x" mindestens 1 beträgt. Dazu wurden pro Spalte 2 Variablen-Positionen innerhalb `lang()` getauscht.
* Sprachdateien:
  * Die bestehenden 2 Sprachvariablen für "Verfügbare Erweiterungen" und "Letzte Versionsprüfung" zu Plural Arrays umgebaut.

### 1.1.3-b10
* Fix: Wenn bei deaktivierter Rückfrage und aktivierter automatischer Bestätigung Erweiterungen geschaltet wurden und dann die ExtMgr Seite manuell neu geladen wurde (z.B. mit F5), dann führte das beim Firefox dazu, dass fälschlicherweise eine Rückfrage zum erneuten Senden der Formulardaten erschien. Wurde diese Rückfrage positiv bestätigt, dann wurde von EMP die letzte Aktion erneut ausgeführt. Das wiederum konnte zu Fehlern führen, wenn in der Zwischenzeit Änderungen im Dateisystem vorgenommen wurden, durch die Erweiterungen ungültig werden, zum Beispiel Strukturfehler in `composer.json`. Eine neue Funktion rotiert jetzt die GET Parameter der URL bei einer automatischen Weiterleitung, was beim Firefox dazu führt, dass keine Rückfrage mehr bezüglich Formulardaten ausgelöst wird. [Meldung von Kirk (phpBB.de)]
* Fix: Das Problem mit dem erneuten Senden der Formulardaten beim Firefox hatte einen Fehler von EMP aufgedeckt, der dann auftreten konnte, wenn Erweiterungen geschaltet wurden, ohne die ExtMgr Seite vorher neu zu laden. Wenn zwischen zwei Schaltvorgängen eine Erweiterung ungültig wurde, also die Metadaten der Erweiterung nicht mehr gelesen werden konnten, dann führte das zu einem FATAL der nicht abgefangen wurde. [Meldung von Kirk (phpBB.de)]

### 1.1.3-b9
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

### 1.1.3-b8
* JS:
  * Die Strikt-Direktive aus den 16 Funktionen entfernt und stattdessen einmal im globalen Namensraum am Anfang der Datei definiert.

### 1.1.3-b7
* Fix: Fehler in `composer.json` behoben. In der VP war noch eine Debug Änderung vorhanden.
* CSS:
  * Von Udo die geänderte Farbe für das Warn-Icon übernommen.
* Code Optimierung.

### 1.1.3-b6
* Code Optimierung:
  * Kleine Verbesserungen.
  * Bei lokaler Versionsprüfung (Details) konnte es mehrere Situationen geben, bei denen unnötig der EMP Versions-Cache in der DB aktualisiert wurde. Grund ist die neue Funktion von 1.1.3-b5 zum signalisieren von VP Fehlern.

### 1.1.3-b5
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

### 1.1.3-b4
* ExtMgr Template:
  * Bei veralteten Erweiterung-Versionen wird jetzt für das rote Veraltet-Icon ebenfalls ein Tooltip angezeigt.
  * In der Versions-Spalte waren die Abstände zwischen Text und Icons zu gross. Ursache waren unerwünschte Whitespaces zwischen Text/Icon und HTML Tags. Jetzt sind alle Texte und Icons innerhalb HTML Container und so lassen sich Abstände präzise definieren.
* JS:
  * Die Initialisierung des `ExtMgrPlus` Objekts war nicht Strikt-kompatibel.
* CSS:
  * Hilfe-Cursor für alle Icons in der Version-Spalte hinzugefügt.
* Sprachdateien:
  * 1 neue Sprachvariable für den neuen Veraltete-Version-Tooltip.

### 1.1.3-b3
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

### 1.1.3-b2
* ExtMgr Template:
  * Wenn eine Erweiterung neue Migrationen hat und die zugehörige Auswahl-Checkbox aufgrund der Einstellungen gesperrt wird, dann wird jetzt ein neuer Tooltip angezeigt, der erklärt, warum die Checkbox gesperrt ist.
  * Um den neuen Tooltip zu ermöglichen ohne zuviel umbauen zu müssen, wird die EMP Auswahl-Checkbox - abhängig von den Einstellungen - ab sofort nicht mehr deaktiviert, sondern gar nicht erst erzeugt. Damit verhält sich die EMP Auswahl-Checkbox genauso wie bei Reihenfolge&Ignorieren, wo für EMP ebenfalls keine Eingabe-Elemente erzeugt werden.
* Sprachdateien:
  * 1 neue Sprachvariable für den neuen Gesperrt-Tooltip.

### 1.1.3-b1
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
