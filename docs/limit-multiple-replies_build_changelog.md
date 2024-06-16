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
