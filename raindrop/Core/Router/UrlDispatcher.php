<?php

namespace Raindrop\Core\Router;


class UrlDispatcher {
	private $methods = [
		'GET',
		'POST'
	];

	public $routes = [//[путь(возм. рег. выр.)]=>[контроллер:экшн]
		'GET' => [],
		'POST' => []
	];

	private $patterns = [
		'int' => '[0-9]+',
		'str' => '[a-zA-Z\.\-_%]',
		'any' => '[a-zA-Z-_%\d]+'
		//'any' => '[a-zA-Z0-9\.\-_%]'
	];

	/**
	 * @param $key
	 * @param $pattern
	 */
	public function addPattern($key, $pattern) {
		$this->patterns[$key] = $pattern;
	}

	public function routes($method) {
		return isset($this->routes[$method]) ? $this->routes[$method] : [];
	}

	/**
	 * Метод регистрирует новый route
	 * @param $method
	 * @param $pattern
	 * @param $controller
	 */
	public function register($method, $pattern, $controller, $plugin) {

		$convert = $this->convertPattern($pattern);

		$controller = $controller.':'.$plugin; // set marker - if the route was added by a plugin

		$this->routes[strtoupper($method)][$convert] = $controller;
	}

	/**
	 * Проверка, есть ли в заданном паттерне маршрута параметры
	 * @param $pattern
	 *
	 * @return mixed
	 */
	private function convertPattern($pattern) {

		if(strpos($pattern,'(') === false) {
			return $pattern;
		}

		return preg_replace_callback('#\((\w+):(\w+)\)#',[$this,'replacePattern'], $pattern);//Возможно, 2 параметр-массив потому что вызываем метод объекта
	}

	/**
	 * В функции заменяем фигню с паттерна на регулярное выражение
	 * @param $matches
	 *
	 * @return string
	 */
	private function replacePattern($matches) {
		return '(?<'.$matches[1].'>'.strtr($matches[2], $this->patterns).')';
	}

	/**
	 * @param $parameters
	 *
	 * @return mixed
	 */
	private function processParam($parameters) {
		foreach($parameters as $key=>$value) {
			if(is_int($key)) {//так как нам нужен ключ 'id'
				unset($parameters[$key]);
			}
		}
		return $parameters;
	}

	/**
	 * @param $method
	 * @param $uri
	 *
	 * @return DispatchedRoute
	 */
	public function dispatch($method, $uri) {
		$routes = $this->routes(strtoupper($method));// получить все роуты метода(POST/GET)

		if(array_key_exists($uri, $routes)) {// если в роутах есть конкретная запись путя, не рег. выр.
			//print_r($routes[$uri]);
			return new DispatchedRoute($routes[$uri]);
		}


		return $this->doDispatch($method, $uri);
	}

	/**
	 * Метод выполняется, если путь в конкретной записи отсутствует(если в паттерне заданы доп.параметры в uri).
	 * Паттерн путя может быть задан рег. выр-ем. И естественно uri не будет ему соответствовать(===), поэтому надо
	 * преобразовать в рег. выр. и тогда сравнивать.
	 *
	 * @param $method
	 * @param $uri
	 *
	 * @return DispatchedRoute
	 */
	private function doDispatch($method, $uri) {

		foreach($this->routes($method) as $route => $controller) {

			$pattern = '#^'. $route . '$#s';
			if(preg_match($pattern, $uri, $parameters)) {//проверка регулярным выражением
				return new DispatchedRoute($controller, $this->processParam($parameters));
			}
		}
	}
}