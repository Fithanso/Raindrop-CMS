<?php

namespace Raindrop\Service\Database;

use Raindrop\Service\AbstractProvider;

use Raindrop\Core\Database\Connection;

class Provider extends AbstractProvider {

	public function __construct( \Raindrop\DI\DI $di ) {
		parent::__construct( $di );
	}
	/**
	 * @var string
	 */
	public $serviceName = 'db';
	/**
	 * @return mixed
	 */
	public function init() {
		$db = new Connection();

		$this->di->set($this->serviceName, $db);

		return $this;
	}

}