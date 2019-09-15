<?php

namespace Raindrop\Core\Router;

class Router {

	private $routes = [];
	private $host;
	private $dispatcher;

	/**
	 * Router constructor.
	 *
	 * @param $host
	 */
	public function __construct($host) {
		$this->host = $host;
	}

	/**
	 * @param $key
	 * @param $pattern
	 * @param $controller
	 * @param string $method
	 */
	public function add($key, $pattern, $controller, $method = 'GET') {
		$this->routes[$key] = [
			'pattern' => $pattern,
			'controller' => $controller,
			'method' => $method,
		];
	}

	/**
	 * @param $method
	 * @param $uri
	 *
	 * @return DispatchedRoute
	 */
	public function dispatch($method, $uri) {
		//print_r($this->routes);
		return $this->getDispatcher()->dispatch($method, $uri);

	}

	/**
	 * Метод создаёт новый UrlDispatcher и регистрирует там все маршруты
	 * @return UrlDispatcher
	 */
	public function getDispatcher() {
		if($this->dispatcher == null) {
			$this->dispatcher = new UrlDispatcher();

			foreach($this->routes as $route) {
				$this->dispatcher->register($route['method'],$route['pattern'],$route['controller']);
			}
		}

		return $this->dispatcher;
	}
}