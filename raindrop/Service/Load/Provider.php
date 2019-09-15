<?php

namespace Raindrop\Service\Load;

use Raindrop\Service\AbstractProvider;

use Raindrop\Load;

class Provider extends AbstractProvider {

	/**
	 * @var string
	 */
	public $serviceName = 'load';
	/**
	 * @return mixed
	 */
	public function init() {
		$load = new Load($this->di);

		$this->di->set($this->serviceName, $load);

		return $this;
	}

}