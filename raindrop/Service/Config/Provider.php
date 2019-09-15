<?php

namespace Raindrop\Service\Config;

use Raindrop\Service\AbstractProvider;

use Raindrop\Core\Config\Config;

class Provider extends AbstractProvider {

	public function __construct( \Raindrop\DI\DI $di ) {
		parent::__construct( $di );
	}
	/**
	 * @var string
	 */
	public $serviceName = 'config';
	/**
	 * @return mixed
	 */
	public function init() {

		$config['main'] = Config::file('main');
		$config['database'] = Config::file('database');
		$this->di->set($this->serviceName, $config);

		return $this;
	}

}