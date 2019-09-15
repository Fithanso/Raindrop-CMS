<?php

namespace Raindrop\Service\Customize;

use Raindrop\Service\AbstractProvider;

use Raindrop\Core\Customize\Customize;

class Provider extends AbstractProvider{

	/**
	 * @var string
	 */
	public $serviceName = 'customize';

	public function init() {
		$customize = new Customize($this->di);

		$this->di->set($this->serviceName, $customize);

		return $this;
	}
}