<?php

namespace Raindrop\Service\Router;

use Raindrop\Service\AbstractProvider;

use Raindrop\Core\Router\Router;

class Provider extends AbstractProvider {

	public function __construct( \Raindrop\DI\DI $di ) {
		parent::__construct( $di );
	}
	/**
	 * @var string
	 */
	public $serviceName = 'router';
	/**
	 * @return mixed
	 */
	public function init() {
		$router = new Router('http://cms');

		$this->di->set($this->serviceName, $router);

		return $this;
	}

}