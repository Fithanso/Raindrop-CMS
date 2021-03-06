<?php

/**
 * Returns path to CMS folder
 * @param string $section
 *
 * @return string
 */


function debug($str) {
	echo '<pre>';
	var_dump($str);
	echo '</pre>';

}


function route($route) {

	if($route == '/') {
		$full_route = $route;
	}else{
		$route = str_replace('.', '/', $route);
		$full_route = '/'.$route;
	}

	return $full_route;

}

function path($section) {

	$pathMask = ROOT_DIR . DIRECTORY_SEPARATOR . '%s';

	if(ENV == 'Cms') {
		$pathMask = ROOT_DIR . DIRECTORY_SEPARATOR . strtolower(ENV) . DS . '%s';
	}

	//Return path to correct section.
	switch (strtolower($section)) {
		case 'controller':
			return sprintf($pathMask, 'Controller');
		case 'config':
			return sprintf($pathMask, 'Config');
		case 'model':
			return sprintf($pathMask, 'Model');
		case 'view':
			return sprintf($pathMask, 'View');
		case 'language':
			return sprintf($pathMask, 'Language');
		default:
			return ROOT_DIR;
	}
}

function path_content($section = '') {

	$pathMask = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'content' . DIRECTORY_SEPARATOR .'%s';

	if(ENV == 'Cms') {
		$pathMask = ROOT_DIR . DIRECTORY_SEPARATOR . strtolower(ENV) . DS . '%s';
	}

	//Return path to correct section.
	switch (strtolower($section)) {
		case 'themes':
			return sprintf($pathMask, 'themes');
		case 'plugins':
			return sprintf($pathMask, 'plugins');
		case 'uploads':
			return sprintf($pathMask, 'uploads');
		default:
			return $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'content';
	}
}


/**
 *Function scans not empty language folders for json config file. It means that language package exists
 */
function languages() {

	$directory = path('language');
	$list = scandir($directory);
	$languages = [];

	if(!empty($list)) {
		unset($list[0]);
		unset($list[1]);

		foreach($list as $dir) {
			$pathLangDir = $directory . DIRECTORY_SEPARATOR . $dir;
			$pathConfig = $pathLangDir . '/config.json';

			if(is_dir($pathLangDir) and is_file($pathConfig)) {
				$config = file_get_contents($pathConfig);
				$info = json_decode($config);

				$languages[] = $info;
			}
		}

	}
	return $languages;
}

/**
 * Return list of themes
 * @return array
 */
function getThemes() {

	$themesPath = '../../content/themes';

	$list = scandir($themesPath);
	$baseUrl = \Raindrop\Core\Config\Config::item('baseUrl');
	$themes = [];

	if(!empty($list)) {
		unset($list[0]);
		unset($list[1]);

		foreach($list as $dir) {
			$pathThemeDir = $themesPath . '/' . $dir;
			$pathConfig = $pathThemeDir . '/theme.json';
			$pathScreen = $baseUrl . '/content/themes/' . $dir . '/screen.jpg';

			if(is_dir($pathThemeDir) and is_file($pathConfig)) {
				$config = file_get_contents($pathConfig);
				$info = json_decode($config);

				$info->screen = $pathScreen;
				$info->dirTheme = $dir;

				$themes[] = $info;
			}
		}

	}
	return $themes;
}

/**
 * Return list of plugins
 * @return array
 */
function getPlugins() {

	global $di;

	$pluginsPath = path_content('plugins');
	$plugins = [];
	$envs = ['Admin', 'Cms'];

	foreach($envs as $env) {
		$list = scandir($pluginsPath.'\\'.$env);

		if(!empty($list)) {
			unset($list[0]);
			unset($list[1]);

			foreach($list as $namePlugin) {

				$namespace = '\\Plugin\\' . $env . '\\' . $namePlugin . '\\Plugin';
				if(class_exists($namespace)) {
					$plugin = new $namespace($di);
					$plugins[$namePlugin] = $plugin->details();
				}
			}

		}
	}

	return $plugins;
}

/**
 * Function searches for files like this: "page-first-type", "page-second-type".
 * So, we can apply many templates(types) for data we want to display
 * @param string $switch
 *
 * @return array
 */
function getTypes($switch = 'page') {

	$themePath = path_content('themes') . '/' . \Setting::get('active_theme');
	$list = scandir($themePath);
	$types = [];

	if(!empty($list)) {
		unset($list[0]);
		unset($list[1]);

		foreach($list as $name) {

			if(\Raindrop\Helper\Common::searchMatchString($name, $switch)) {
				list($switch, $key) = explode('-', $name, 2);

				if(!empty($key)) {
					list($nameType) = explode('.', $key ,2);
					$types[$nameType] = ucfirst($nameType);
				}
			}
		}
	}

	return $types;
}