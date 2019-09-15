<?php

namespace Raindrop\Service\View;

use Raindrop\Service\AbstractProvider;

use Raindrop\Core\Template\View;

class Provider extends AbstractProvider {

	public function __construct( \Raindrop\DI\DI $di ) {
		parent::__construct( $di );
	}

	/**
	 * @var string
	 */
	public $serviceName = 'view';
	/**
	 * @return mixed
	 */
	public function init() {
		$view = new View($this->di);

		$this->di->set($this->serviceName, $view);

	}

}