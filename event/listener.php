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

namespace lukewcs\limitreplies\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	protected $language;
	protected $template;
	protected $config;
	protected $auth;
	protected $user;
	protected $db;
	protected $phpbb_root_path;
	protected $php_ext;

	protected $wait_time;

	public function __construct(
		\phpbb\language\language $language,
		\phpbb\template\template $template,
		\phpbb\config\config $config,
		\phpbb\auth\auth $auth,
		\phpbb\user $user,
		\phpbb\db\driver\driver_interface $db,
		$phpbb_root_path,
		$php_ext
	)
	{
		$this->language			= $language;
		$this->template			= $template;
		$this->config			= $config;
		$this->auth				= $auth;
		$this->user				= $user;
		$this->db				= $db;
		$this->phpbb_root_path	= $phpbb_root_path;
		$this->php_ext			= $php_ext;

		$this->wait_time		= $this->config['limitreplies_number_wait_time'] * 60;
	}

	public static function getSubscribedEvents(): array
	{
		return array(
			'core.viewtopic_modify_page_title' 	=> 'set_template_vars',
			'core.modify_posting_auth'			=> 'check_posting',
			'core.permissions'					=> 'add_permissions',
		);
	}

	public function set_template_vars($event): void
	{
// var_dump($event);
// var_dump('set_template_vars');

		if ($this->user->data['user_type'] == USER_IGNORE
			|| $this->auth->acl_get('u_limitreplies_bypass_lock')
			|| !$this->config['limitreplies_switch_enable']
			|| $event['topic_data']['topic_status'] == ITEM_LOCKED
		)
		{
			return;
		}

		$locked_until_time = $this->get_lock_time($event['topic_data']);

		if ($locked_until_time)
		{
			$this->template->assign_vars([
				'S_QUICK_REPLY' 				=> false,
				'LIMITREPLIES_MESSAGE' 			=> (string) $this->get_message($locked_until_time),
				'LIMITREPLIES_SWITCH_SHOW_HINT'	=> (bool) $this->config['limitreplies_switch_show_hint'],
			]);
		}
	}

	public function check_posting($event): void
	{
// var_dump($event);
// var_dump('check_posting');

		if ($this->user->data['user_type'] == USER_IGNORE
			|| !in_array($event['mode'], ['reply', 'quote', 'bump'])
			|| $this->auth->acl_get('u_limitreplies_bypass_lock')
			|| !$this->config['limitreplies_switch_enable']
			|| $event['post_data']['topic_status'] == ITEM_LOCKED
		)
		{
			return;
		}

		$locked_until_time = $this->get_lock_time($event['post_data']);

		if ($locked_until_time)
		{
			trigger_error($this->get_message($locked_until_time));
		}
	}

	public function add_permissions($event): void
	{
		// $permissions = $event['permissions'];
		// $permissions['u_limitreplies_bypass_lock'] = ['lang' => 'ACL_U_LIMITREPLIES_BYPASS_LOCK', 'cat' => 'post'];
		// $event['permissions'] = $permissions;

		$event->update_subarray('permissions', 'u_limitreplies_bypass_lock', ['lang' => 'ACL_U_LIMITREPLIES_BYPASS_LOCK', 'cat' => 'post']);
	}

	private function get_nru_group_id(): ?int
	{
		$sql = 'SELECT group_id
				FROM ' . GROUPS_TABLE . '
				WHERE group_name = "NEWLY_REGISTERED"
					AND group_type = ' . GROUP_SPECIAL;
		$result = $this->db->sql_query($sql, 86400);
		$nru_group_id = $this->db->sql_fetchfield('group_id');
		$this->db->sql_freeresult($result);

		return $nru_group_id !== false ? $nru_group_id : null;
	}

	private function get_last_unapproved_post_row(int $topic_id, int $poster_id): ?array
	{
		$sql = 'SELECT *
				FROM ' . POSTS_TABLE . '
				WHERE topic_id = ' . (int) $topic_id . '
					AND poster_id = ' . (int) $poster_id . '
					AND post_visibility = 0
				ORDER BY post_time DESC LIMIT 1';
		$result = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		return $row !== false ? $row : null;
	}

	private function get_lock_time(array $topic_data): int
	{
// var_dump('topic_status', $topic_data['topic_status']);
// var_dump('topic_posts_unapproved', $topic_data['topic_posts_unapproved']);
// var_dump('user_id', $this->user->data['user_id']);
// var_dump('topic_id', $topic_data['topic_id']);

		if (!function_exists('group_memberships'))
		{
			include($this->phpbb_root_path . 'includes/functions_user.' . $this->php_ext);
		}

		$locked_until_time = 0;
		$nru_group_id = $this->get_nru_group_id();

		// There are posts in the topic's queue and the user is an NRU
		if ($topic_data['topic_posts_unapproved']
			&& $nru_group_id !== null && group_memberships($nru_group_id, $this->user->data['user_id'], true)
		)
		{
// var_dump('IF #1');
			$last_unapproved_post_row = $this->get_last_unapproved_post_row($topic_data['topic_id'], $this->user->data['user_id']);
// var_dump('last_unapproved_post_row', $last_unapproved_post_row !== null);
// var_dump('unapproved:post_id', $last_unapproved_post_row['post_id'] ?? null);
// var_dump('unapproved:poster_id', $last_unapproved_post_row['poster_id'] ?? null);
// var_dump('unapproved:post_time', $last_unapproved_post_row['post_time'] ?? null);

			if ($last_unapproved_post_row !== null && $last_unapproved_post_row['post_time'] > $topic_data['topic_last_post_time'])
			{
// var_dump('IF #2');
				$locked_until_time = $last_unapproved_post_row['post_time'] + $this->wait_time;
			}
			else if ($topic_data['topic_last_poster_id'] == $this->user->data['user_id'])
			{
// var_dump('IF #3');
				$locked_until_time = $topic_data['topic_last_post_time'] + $this->wait_time;
			}
		}
		// There are no posts in the topic's queue, or the user is not an NRU
		else if ($topic_data['topic_last_poster_id'] == $this->user->data['user_id'])
		{
// var_dump('IF #4');
			$locked_until_time = $topic_data['topic_last_post_time'] + $this->wait_time;
		}
// var_dump('get_lock_time', $locked_until_time);

		return $locked_until_time > time() ? $locked_until_time : 0;
	}

	private function get_message(int $locked_until_time): string
	{
		$this->language->add_lang('limitreplies', 'lukewcs/limitreplies');

		return $this->language->lang('LIMITREPLIES_MSG_REPLY_DENIED',
			$this->language->lang('LIMITREPLIES_MINUTES_PLURAL', $this->config['limitreplies_number_wait_time']),
			$this->user->format_date($locked_until_time)
		);
	}
}
