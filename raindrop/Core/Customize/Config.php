<?php

namespace Raindrop\Core\Customize;

/**
 * Class Config
 * @package Engine\Core\Customize
 */
class Config {

	/**
	 * @var array
	 */
	protected $config = [
		'dashboardMenu' => [
			'web-site' => [
				'classIcon' => 'icon-speedometer icons',
				'urlPath' => '/',

			],
			'pages' => [
				'classIcon' => 'icon-doc icons',
				'urlPath' => '/admin/pages/',

			],
			'posts' => [
				'classIcon' => 'icon-pencil icons',
				'urlPath' => '/admin/posts/',

			],
			'users' => [
				'classIcon' => 'icon-user icons ',
				'urlPath' => '/admin/users/all_users/',

			],
			'settings' => [
				'classIcon' => 'icon-equalizer icons',
				'urlPath' => '/admin/settings/general/',

			],
			'plugins' => [
				'classIcon' => 'icon-wrench icons',
				'urlPath' => '/admin/plugins/',

			]
		],
		'settingsMenu' => [
			'general' => [
				'urlPath' => '/admin/settings/general/',
				'title' => 'General'
			],
			'themes' => [
				'urlPath' => '/admin/settings/appearance/themes/',
				'title' => 'Themes'
			],
			'menus' => [
				'urlPath' => '/admin/settings/appearance/menus/',
				'title' => 'Menus'
			],
		],
		'usersManagementMenu' => [
			'all_users' => [
				'urlPath' => '/admin/users/all_users/',
				'title' => 'All users'
			],
			'admins' => [
				'urlPath' => '/admin/users/admins/',
				'title' => 'Administrators'
			],
			'banned' => [
				'urlPath' => '/admin/users/banned/',
				'title' => 'Banned users'
			],
		],


	];

	/**
	 * @param $key
	 *
	 * @return bool
	 */
	public function has($key) {
		return isset($this->config[$key]);
	}

	/**
	 * @param $key
	 *
	 * @return mixed|null
	 */
	public function get($key) {
		return $this->has($key) ? $this->config[$key] : null;
	}

	/**
	 * @param $key
	 * @param $value
	 */
	public function set($key, $value) {
		$this->config[$key] = $value;
	}

}