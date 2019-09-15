<?php

namespace Raindrop\Service\Request;

use Raindrop\Service\AbstractProvider;

use Raindrop\Core\Request\Request;

class Provider extends AbstractProvider {

	public function __construct( \Raindrop\DI\DI $di ) {
		parent::__construct( $di );
	}
	/**
	 * @var string
	 */
	public $serviceName = 'request';
	/**
	 * @return mixed
	 */
	public function init() {
		$request = new Request();

		$this->di->set($this->serviceName, $request);

		return $this;
	}

}