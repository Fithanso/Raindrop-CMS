<?php

namespace Raindrop\Core\Template;

use Raindrop\Core\Config\Config;
use Raindrop\DI\DI;

/**
 * Класс нужен для подключения частей страницы-хедера, футера, сайдбара, блоков.
 * Class Theme
 * @package Raindrop\Core\Template
 */
class Theme {

	const RULES_NAME_FILE = [//массив-константа с заготовками для имен файлов с html
		'header' => 'header-%s',
		'footer' => 'footer-%s',
		'sidebar' => 'sidebar-%s',
	];

	const URL_THEME_MASK = '%s/content/themes/%s';

	/**
	 * Url of current theme
	 * @type string
	 */
	protected static $url = '';

	/**
	 * @var array
	 */
	protected static $data = [];

	/**
	 * @var Asset
	 */
	public $asset;

	/**
	 * @var Theme
	 */
	public $theme;

	public function __construct() {
		$this->theme = $this;
		$this->asset = new Asset();
	}

	/**
	 * @param null $name
	 */
	public static function header($name = null) {
		$name = (string) $name;
		$file = self::detectNameFile($name, __FUNCTION__);

		Component::load($file);
	}

	/**
	 * @param string $name
	 */
	public static function footer($name = '') {
		$name = (string) $name;
		$file = self::detectNameFile($name, __FUNCTION__);

		Component::load($file);

	}

	/**
	 * @param string $name
	 */
	public function sidebar($name = '') {
		$name = (string) $name;
		$file = self::detectNameFile($name, __FUNCTION__);

		Component::load($file);

	}

	/**
	 * @param string $name
	 * @param array $data
	 */
	public static function block($name = '', $data=[]) {
		$name = (string) $name;

		if($name !== '') {
			Component::load($name, $data);
		}

	}

	/**
	 * @param $nameFile
	 * @param array $data
	 *
	 * @throws \Exception
	 */
	public function loadTemplateFile($nameFile,$data=[]) {

		$templateFile = ROOT_DIR . '/content/themes/default/'. $nameFile.'.php';

		if(ENV == 'Admin') {
			$templateFile = ROOT_DIR . '/View/'. $nameFile.'.php';

		}

		if(is_file($templateFile)) {
			extract(array_merge($data,$this->data));//тут экстрактятся переменные для вложенных в тему файлов
			require_once $templateFile;
		}else{

			throw new \Exception(sprintf('View File %s does not exists',$templateFile));
		}
	}

	/**
	 * @return array
	 */
	public static function getData() {
		return static::$data;
	}

	/**
	 * @param array $data
	 */
	public function setData($data = []) {
		static::$data = $data;
	}

	/**
	 * Constant __FUNCTION__ returns function's name(header, footer, sidebar)
	 * @param $name
	 * @param $function
	 *
	 * @return string
	 */
	private static function detectNameFile($name, $function) {
		return empty(trim($name)) ? $function : sprintf(self::RULES_NAME_FILE[$function], $name);
	}

	/**
	 * @return string
	 */
	public static function getUrl() {
		$currentTheme = Config::item('defaultTheme', 'main');
		$baseUrl = Config::item('baseUrl', 'main');
		return sprintf(self::URL_THEME_MASK, $baseUrl, $currentTheme);
	}

	public static function getThemePath($theme = 'default') {
		return ROOT_DIR . DIRECTORY_SEPARATOR . 'content' . DIRECTORY_SEPARATOR . 'themes'. DIRECTORY_SEPARATOR . $theme;
	}

	/**
	 * Show title
	 */
	public static function title() {
		$nameSite = Setting::get('site_name');
		$description = Setting::get('description');

		if($description != '') {
			echo $nameSite. ' | '.$description;
		}else{
			echo $nameSite;
		}


	}


}