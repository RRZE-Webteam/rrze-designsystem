[![Aktuelle Version](https://img.shields.io/github/package-json/v/rrze-webteam/rrze-designsystem/main?label=Version)](https://github.com/RRZE-Webteam/rrze-designsystem) [![Release Version](https://img.shields.io/github/v/release/rrze-webteam/rrze-designsystem?label=Release+Version)](https://github.com/rrze-webteam/rrze-designsystem/releases/) [![GitHub License](https://img.shields.io/github/license/rrze-webteam/rrze-designsystem)](https://github.com/RRZE-Webteam/rrze-designsystem) [![GitHub issues](https://img.shields.io/github/issues/RRZE-Webteam/rrze-designsystem)](https://github.com/RRZE-Webteam/rrze-designsystem/issues)
![GitHub milestone details](https://img.shields.io/github/milestones/progress-percent/RRZE-Webteam/rrze-designsystem/1)
![GitHub milestone details](https://img.shields.io/github/milestones/progress-percent/RRZE-Webteam/rrze-designsystem/2)

# RRZE Designsystem
RRZE Designsystem ermöglicht es, einfach und übersichtlich Designsysteme anzulegen und zu verwalten. Version 1 enthält diese Bestandteile

- Verwaltung von Design Tokens (Typographie, Farbwahl, Spacing, etc.)
- Verwaltung von Design-Elementen (z.B. wiederkehrende Elmenete wie Accordions)

## Shortcodes
Das Plugin unterstüztt die Folgenden Shortcodes:
- ```[font_table category="{$category_name}"]``` – Ausgabe der Farben
- ```[space_table category="{$category_name}"]``` - Ausgabe der Fonts
- ```[boxshadow_table category="{$category_name}"]``` - Ausgabe der Schatten
- ```[length_table category="{$category_name}"]``` - Ausgabe der Längenparameter
- ```[breakpoint_table category="{$category_name}"]``` - Ausgabe der Breakpoints
- ```[mediaquery_table category="{$category_name}"]``` - Ausgabe der Mediaqueries
- ```[border_table category="{$category_name}"]``` - Ausgabe der Rahmeneigenschaften
- ```[icon_table category="{$category_name}"]``` - Ausgabe der Icons
- ```[Designelement element="{$element_id}" section="{$section_name}"]``` - Ausgabe von Designelementen. ```$element_id```: Die ID des Element-Eintrags.

## Blöcke

Im Block-Editor steht die eigene Kategorie **RRZE Design System** zur Verfügung. Sie enthält:

- Token-Tabellen für Farben, Schriften, Abstände, Schatten, Deckkraft, Längen, Breakpoints, Media Queries, Rahmen und Icons
- den Block **Design Element** zur Ausgabe eines vollständigen Elements oder eines einzelnen Dokumentationsabschnitts

Die Blöcke werden serverseitig gerendert und zeigen daher immer den aktuellen Stand der zugehörigen Design-Token- und Element-Einträge. Block-Werkzeugleiste und Seitenleiste bieten Einstellungen für Typ, Kategorie, Überschrift, Darstellung und Abschnitt.

## Entwicklung
Tipps zur Entwicklung finden sich unter /docs

## Fehler melden & Feedback
Feedback und Fehler können als Issue im GitHub Repository oder als E-Mail an webmaster@fau.de mit Betreff "WP Block Boilerplate" gemeldet werden.
