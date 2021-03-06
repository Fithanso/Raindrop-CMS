<?php

namespace Cms\Classes;

/**
 * Class Page gives nice data representation to be used in templates with aliases
 * @package Cms\Classes
 */
class Page {

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