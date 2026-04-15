### 1.1.0
(2026-04-15)

* Fix: Im ACP Modul einen kleinen Fehler bei Responsive behoben, wodurch der Titel der Einstellungen-Gruppe nach links versetzt dargestellt wurde.
* Fix: Im ACP Modul konnte bei "Wartezeit zwischen zwei Beiträgen:" ein leeres Eingabefeld gespeichert werden, was dann in der Datenbank als `0` gespeichert wurde.
* Basierend auf einem Vorschlag, stehen jetzt in den Einstellungen bei der Wartezeit zusätzlich zu Minuten auch Stunden und Tage zur Auswahl. [Vorschlag von: Leinad4Mind (phpBB.com)]
  * Je nach Auswahl der Wartezeit-Einheit ändert sich dadurch auch in der Erklärung (Info-Kasten, Info-Popup) die Anzeige der Wartezeit zwischen Minuten, Stunden und Tage.
  * Per Standard ist die Auswahl auf "Minuten" voreingestellt, damit eine bereits vorhandene Einstellung der Wartezeit ohne Änderung beibehalten werden kann.
* Optionsgruppen im ACP Modul werden jetzt ausgeblendet, wenn Ext über den eigenen Hauptschalter deaktiviert wird, wie bei Force Account Reactivation.
* Technik auf den Stand von Extension Manager Plus 3.1 und Toggle Control 1.3 gebracht, Details im Build Changelog.
* Die Voraussetzungen haben sich geändert:
  * PHP: 8.0.0 - 8.5.x (Bisher: 7.4.0 - 8.4.x)

### 1.0.2
(2024-12-13)

* Die Voraussetzungen haben sich geändert:
  * PHP: 7.4.0 - 8.4.x (Bisher: 7.1.3 - 8.3.x)
* Technik auf den Stand von EMP 3.0 gebracht, Details im Build Changelog.

### 1.0.1
(2024-07-06)

* Gründer sind jetzt ebenfalls ausgeschlossen.
* Nicht mehr benötigten Code entfernt und Code Optimierung.

### 1.0.0
(2024-06-23)

* Erste offizielle Version.
