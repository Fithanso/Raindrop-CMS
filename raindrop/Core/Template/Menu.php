<?php
/**
 * Created by PhpStorm.
 * User: Fithanso
 * Date: 24.06.2019
 * Time: 12:20
 */

namespace Raindrop\Core\Template;

use Raindrop\DI\DI;
use Cms\Model\MenuItem\MenuItemRepository;

class Menu {

	protected static $di;

	/**
	 * @var MenuItemRepository
	 */
	protected static $menuItemRepository;

	public function __construct($di) {

		self::$di = $di;
		self::$menuItemRepository = new MenuItemRepository(self::$di);
	}

	public static function show() {

	}

	public static function getItems($menuId) {
		return self::$menuItemRepository->getItems($menuId);
	}



}