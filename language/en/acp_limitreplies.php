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
	'LIMITREPLIES_CONFIG_TITLE'			=> 'Limit Multiple Replies',
	'LIMITREPLIES_CONFIG_DESC'			=> 'Here you can change the settings for the extension <strong>%s</strong>.',

	'LIMITREPLIES_SETTINGS_TITLE'		=> 'Settings',
	'LIMITREPLIES_ENABLE'				=> 'Enable function',
	'LIMITREPLIES_ENABLE_EXPLAIN'		=> 'With this switch you can deactivate the functionality without having to deactivate the extension completely.',
	'LIMITREPLIES_WAIT_TIME'			=> 'Waiting time',
	'LIMITREPLIES_WAIT_TIME_EXPLAIN'	=> 'Here you can specify after which waiting time a new reply is allowed if the last post was from the same user. This value is also displayed in the explanation.',
	'LIMITREPLIES_MINUTES'				=> 'minutes',
	'LIMITREPLIES_SHOW_HINT'			=> 'Show explanation',
	'LIMITREPLIES_SHOW_HINT_EXPLAIN'	=> 'If this switch is activated, the explanation is displayed permanently. Otherwise only when the "Reply" button is clicked.',

	'LIMITREPLIES_MSG_SETTINGS_SAVED'	=> 'Limit Multiple Replies: Settings saved successfully',
]);
