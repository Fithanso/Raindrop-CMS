<?php

namespace Raindrop;

use Raindrop\Core\Router\DispatchedRoute;
use Raindrop\Helper\Common;
use Raindrop\Core\Config\Config;
use Raindrop\Core\Auth\Auth;

class Cms {

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

			$routerDispatch = $this->router->dispatch( Common::getMethod(), Common::getPathUrl() );

			if($this->checkFirstLaunch()) {
				$routerDispatch = new DispatchedRoute( 'PreLaunchController:preLaunch' );
			}

			if ( $routerDispatch == null ) {//если UrlDispatcher(по факту) вообще ничего не return
				$routerDispatch = new DispatchedRoute( 'ErrorController:page404' );
			}

			list( $class, $action ) = explode( ':', $routerDispatch->getController(), 2 );

			$controller = "\\". ENV_NAMESPACE ."\\Controller\\" . $class;
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

		$file = file_get_contents(__DIR__.'/sys_data.ini');

		if($file == '') {
			return true;
		}

		return false;
	}

}