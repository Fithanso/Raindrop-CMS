<?php

namespace Raindrop;

use Raindrop\Core\Router\DispatchedRoute;
use Raindrop\Helper\Common;
use Raindrop\Core\Config\Config;
use Raindrop\Core\Auth\Auth;

class Cms {

	const MASK_PLUGIN = 'Plugin\%s\%s\Plugin';

	/**
	 * @var DI
	 *
	 */
	private $di;

	public $router;
	/**
	 * cms constructor.
	 *
	 * @param $di
	 */
	public function __construct($di) {
		$this->di = $di;
		$this->router = $this->di->get('router');
	}

	/**
	 * Run cms
	 */
	public function run() {

		try {


			require_once __DIR__.ENV_PATH.'/'.mb_strtolower(ENV).'/Route.php';

			$this->applyPlugins();

			$routerDispatch = $this->router->dispatch( Common::getMethod(), Common::getPathUrl() );
			// here at a call of preLaunchController and ErrorController null is written at the end, because these routes
			// weren't properly added to the list of routes, so we need to mark that these two routes are not added by any plugin
			if($this->checkFirstLaunch()) {
				$routerDispatch = new DispatchedRoute( 'PreLaunchController:preLaunch:0' );
			}

			if ( $routerDispatch == null ) {//if UrlDispatcher returns something
				$routerDispatch = new DispatchedRoute( 'ErrorController:page404:0' );
			}

			list( $class, $action, $plugin ) = explode( ':', $routerDispatch->getController(), 3 );

			if ($plugin) {
				$plugin_name = substr($class, 0, strpos($class, 'Controller'));
				$controller = "Plugin\\".$plugin_name."\\".$plugin_name."Controller";
				//"\\". ENV_NAMESPACE ."\\Controller\\" . $class

			}else{
				$controller = "\\". ENV_NAMESPACE ."\\Controller\\" . $class;
			}



			$parameters = $routerDispatch->getParameters();

			call_user_func_array( [ new $controller( $this->di ), $action], $parameters);// вызываем метод у класса; с параметрами
		}catch (\Exception $e) {
			echo $e->getMessage();
			exit;
		}

	}

	/**
	 *
	 * Function returns true if CMS is being activated for the first time.
	 *
	 * @return bool
	 */
	private function checkFirstLaunch() {

		$path = __DIR__.'/../cms/Config/main.json';
		$json = file_get_contents($path);
		$d = json_decode($json);

		$items = json_decode(json_encode($d), true);

		if($items["active"] == '0') {
			return true;
		}

		return false;
	}

	/**
	 * @return array
	 */
	private function getActivePlugins(){
		$load = $this->di->get('load');
		$plugins = $load->model('Plugin');
		$plugins = $plugins->plugin->getActivePlugins();

		return $plugins;
	}

	private function applyPlugins() {
		$plugins = $this->getActivePlugins();
		foreach ($plugins as $plugin) {
			$class_name = sprintf(self::MASK_PLUGIN, ENV, $plugin->directory);
			if (class_exists($class_name)) {
				$plugin = new $class_name($this->di);
				$plugin->init();
			}

		}
	}

}