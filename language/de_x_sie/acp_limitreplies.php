<?php
/**
*
* Limit Multiple Replies. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2024, LukeWCS, https://github.com/LukeWCS
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
* Note: This extension is 100% genuine handcraft and consists of selected
*       natural raw materials. There was no AI involved in making it.
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ « » “ ” … „ “

$lang = array_merge($lang, [
	'LIMITREPLIES_CONFIG_TITLE'			=> 'Mehrfachantworten begrenzen',
	'LIMITREPLIES_CONFIG_DESC'			=> 'Hier können Sie die Einstellungen für die Erweiterung <strong>%s</strong> ändern.',

	'LIMITREPLIES_SETTINGS_TITLE'		=> 'Einstellungen',
	'LIMITREPLIES_ENABLE'				=> 'Funktion aktivieren',
	'LIMITREPLIES_ENABLE_EXPLAIN'		=> 'Mit diesem Schalter können Sie die Funktionalität deaktivieren, ohne die Erweiterung komplett deaktivieren zu müssen.',
	'LIMITREPLIES_WAIT_TIME'			=> 'Wartezeit',
	'LIMITREPLIES_WAIT_TIME_EXPLAIN'	=> 'Hier können Sie festlegen, nach welcher Wartezeit eine erneute Antwort erlaubt ist, wenn der letzte Beitrag vom selben Benutzer stammt. Dieser Wert wird auch in der Erklärung angezeigt.',
	'LIMITREPLIES_MINUTES'				=> 'Minuten',
	'LIMITREPLIES_SHOW_HINT'			=> 'Erklärung anzeigen',
	'LIMITREPLIES_SHOW_HINT_EXPLAIN'	=> 'Wenn dieser Schalter aktiviert ist, wird die Erklärung dauerhaft angezeigt. Ansonsten nur, wenn der „Antworten“ Button angeklickt wird.',

	'LIMITREPLIES_MSG_SETTINGS_SAVED'	=> 'Mehrfachantworten begrenzen: Einstellungen erfolgreich gespeichert',
]);
