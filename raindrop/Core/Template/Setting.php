<?php

namespace Raindrop\Core\Template;

use Raindrop\Admin\Model\Setting\SettingRepository;
use Raindrop\Di\DI;

class Setting {

	/**
	 * @var DI
	 */
	protected static $di;

	/**
	 * @var SettingRepository
	 *
	 */
	protected static $settingRepository;

	public function __construct($di) {

		self::$di = $di;
		self::$settingRepository = new SettingRepository(self::$di);
	}

	public static function get($keyField) {
		return self::$settingRepository->getSettingValue($keyField);
	}



}