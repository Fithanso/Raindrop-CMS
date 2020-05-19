<?php
/**
 * Created by PhpStorm.
 * User: Fithanso
 * Date: 23.04.2020
 * Time: 14:58
 */

namespace Cms\Classes;

/**
 * Class Post gives nice data representation to be used in templates with aliases
 * @package Cms\Classes
 */

class Post {
	public static $store;

	public static function setStore($store){
		self::$store = $store;
	}

	/**
	 * @return mixed
	 */
	public static function getStore() {
		return self::$store;
	}

	public static function title() {
		echo static::$store->title;
	}

	public static function content() {
		echo static::$store->content;
	}
}