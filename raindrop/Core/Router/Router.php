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
	 * @param int $plugin must be 1 if a route is added through plugin
	 */
	public function add($key, $pattern, $controller, $method = 'GET', $plugin = 0) {
		$this->routes[$key] = [
			'pattern' => $pattern,
			'controller' => $controller,
			'method' => $method,
			'plugin' => $plugin
		];
	}

	/**
	 * @param $method
	 * @param $uri
	 *
	 * @return DispatchedRoute
	 */
	public function dispatch($method, $uri) {
		return $this->getDispatcher()->dispatch($method, $uri);

	}

	/**
	 * The method creates new UrlDispatcher and registrates all routes there
	 * @return UrlDispatcher
	 */
	public function getDispatcher() {
		if($this->dispatcher == null) {
			$this->dispatcher = new UrlDispatcher();


			foreach($this->routes as $route) {

				$this->dispatcher->register($route['method'],$route['pattern'],$route['controller'], $route['plugin']);
			}
			//print_r($this->dispatcher->routes);
		}

		return $this->dispatcher;
	}
}