<?php

namespace Raindrop\Core\Customize;

use Raindrop\DI\DI;

/**
 * Class Customize
 * @package Engine\Core\Customize
 */
class Customize {

	public static $di;

	/**
	 * @var Config
	 */
	protected $config;

	/**
	 * @var null|Customize
	 */
	private static $instance = null;

	public function __construct(DI $di) {

		static::$di = $di;
		$this->config = new Config();
	}

	public function getConfig() {
		return $this->config;
	}

	protected function __clone() {

	}

	/**
	 * @return Customize|null
	 */
	public static function getInstance() {

		if(is_null(self::$instance)) {
			self::$instance = new self(static::$di);
		}
		return self::$instance;
	}

	public function getAdminMenuItems() {
		return $this->getConfig()->get('dashboardMenu');
	}

	public function getSettingsMenuItems() {
		return $this->getConfig()->get('settingsMenu');
	}

	public function getUsersManagementMenuItems() {
		return $this->getConfig()->get('usersManagementMenu');
	}
}