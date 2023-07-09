# IP's Kauf auf Anfrage Plugin

## Installation

Das Plugin sollte entsprechend der Standard-Plugin-Installation installiert werden - entweder über die Konsole oder das Backend des Shops.

Während der Installation wird das benutzerdefinierte Feld zusammen mit dem erforderlichen benutzerdefinierten Feldsatz erstellt.

Hinweis: Während der Installation wird geprüft, ob das Feld bereits vorhanden ist oder nicht. Das erleichtert die Arbeit mit DB-Dumps.

## Verwendung

Nach der Installation und Aktivierung sind folgende Änderungen vorhanden:
* In der Administration finden Sie das neue benutzerdefinierte Feld für Produkte, das entweder ein- oder ausgeschaltet werden kann (standardmäßig ausgeschaltet).
* Wenn der Schalter aktiv ist, wird der Kauf-Button für dieses Produkt deaktiviert und die Beschriftung des Buttons geändert
* Außerdem prüft das Plugin jeden Warenkorb auf das Vorhandensein solcher Produkte und entfernt sie, wobei es eine Fehlermeldung ausgibt