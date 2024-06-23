### 1.0.0
* Release (2024-06-23)
* Fix: Wenn die Wartezeit auf 1 Minute eingestellt war, dann wurde das als "1 Minuten" ausgegeben, weil die Plural-Funktion von `lang()` offensichtlich explizit einen Integer als Key benötigt, damit das funktioniert.

#### 1.0.0-rc2
* Fix: Die Situation Foren-Freigabe in Kombination mit normalen Benutzern - also keine NRUs - führte dazu, dass ein Benutzer beliebig viele Beiträge in die Warteschlange des Themas setzen konnte. Ursache war die unnötige Prüfung, ob ein Benutzer ein NRU ist, denn nur bei einem NRU wurde die Warteschlange geprüft.
* Foren Frontend:
  * CSS erneut überarbeitet: Padding und Margin wieder reaktiviert und etwas angepasst, da es sonst bei bestimmten Styles zu einer sehr ungünstigen Darstellung bei der dauerhaften Info-Box kommen kann.

#### 1.0.0-rc1
* Migration:
  * Bei der Benutzer-Rolle "Funktionalitäten für neu registrierte Benutzer" wird das LMR Recht jetzt bei Installation auf Nie gesetzt. Also vorher b2 deinstallieren.
* Mindestversion bei phpBB auf 3.3.2 erhöht, da in der Migration beim Permission Tool eine neue Funktion genutzt wird.
* Foren Frontend:
  * Statt bei der permanenten Anzeige eigenes CSS zu definieren, wird jetzt das Standard Post CSS verwendet. Dadurch funktioniert LMR bei möglichst vielen Styles, ohne das Anpassungen nötig wären. So wurde jetzt auch das meiste CSS überflüssig und wurde entfernt. [Vorschlag von Kirk (phpBB.de)]
* Code Optimierung.
* Sprachdateien:
  * Texte überarbeitet.

#### 1.0.0-b2
* ACP Modul:
  * Den Schalter bei "Erklärung anzeigen" durch ein Auswahlmenü ersetzt, damit diese Einstellung intuitiver und gleichzeitig flexibler wird.
  * Twig Makro `select()` von FAR übernommen, mit dem Auswahlmenüs in Templates einfacher und effizienter realisiert werden können.
* ACP Controller:
  * Controller an das neue Auswahlmenü angepasst.
  * Funktion `select_struct` von FAR übernommen zum Bauen einer Select Struktur fürs Template.
* Foren Frontend:
  * Bei der Klick-abhängigen Anzeige der Erklärung wird nicht mehr die bisherige Variante für die permanente Anzeige verwendet, sondern die phpBB Popup Funktion `phpbb.alert()`. Dadurch wurde es jetzt möglich, dass man auch bei den Zitat-Buttons die Erklärung anzeigen kann.
  * Bei der permanenten Anzeige der Erklärung wird jetzt ein `not-allowed` Pointer bei den Antwort- und Zitat-Buttons verwendet. [Vorschlag von Kirk (phpBB.de)]
* Listener:
  * Generierung der Template Variable für den Erklärung-Modus wurde auf das neue Auswahlmenü umgestellt.
  * Bei `get_last_unapproved_post` werden jetzt nur noch relevante Felder aus der DB abgefragt, nicht mehr der komplette Datensatz des Beitrags.
* JS:
  * Code an die Änderungen bei den Buttons und der Erklärung angepasst.
* Migration:
  * Die Migration 1.0.0 musste geändert werden, da die Variable für den Erklärung-Modus jetzt ein Menü ist, kein Schalter mehr. Also vorher b1 deinstallieren.
* Sprachdateien:
  * Texte überarbeitet.
  * 2 Variablen umbenannt.
  * 2 neue Variablen für das Auswahlmenü.

#### 1.0.0-b1
* Erste interne Testversion.
* Online Versionsprüfung bereits eingebaut und im Repo eingerichtet. Die VP zeigt jedoch während der Beta immer, dass die Version aktuell ist.
* Änderungen/Neuerungen gegenüber "Deny double posts":
  * Statt einem hardcodet Wert für die Anzahl Sekunden gibts jetzt ein ACP Modul mit paar Einstellungen.
  * Statt einem hardcodet Foren-Recht (Moderator Recht) gibt es jetzt ein eigenes Gruppen-Recht mit dem bei jeder Gruppe individuell festgelegt werden kann, ob sie die Sperre umgehen darf. Bei Admins und GlobMods ist das Recht per Standard bereits gesetzt. 
    * Gruppenrechte > Beiträge > Mehrfachantworten begrenzen: Kann Wartezeit umgehen
  * Die Antwort-Buttons werden nicht mehr entfernt, sondern lediglich leicht abgeblendet, aber deren Funktion deaktiviert.
  * Die Zitat-Buttons werden jetzt ebenfalls berücksichtigt und genauso abgeblendet und deren Funktion deaktiviert.
  * Es gibt jetzt eine Erklärung die erscheint, wenn einer der beiden Antwort-Buttons geklickt wird. Alternativ kann die Erklärung auch direkt angezeigt werden. Diese enthält die Angaben über die Wartezeit und das genaue Datum/Uhrzeit, wann wieder gepostet werden darf.
  * Berücksichtigt jetzt auch die NRUs. Das heisst; nicht nur der letzte sichtbare Beitrag wird für die Entscheidung der Sperre herangezogen, sondern auch die Beiträge in der Warteschlange, die noch freigegeben werden müssen. Somit wird bei NRUs effektiv verhindert, dass diese in einem Thema innerhalb kürzester Zeit zig Posts (in die Warteschlange) absetzen können. Dabei wird die Warteschlange für jeden NRU individuell betrachtet. Es spielt also keine Rolle, welcher Beitrag in der Warteschlange tatsächlich der letzte ist.
