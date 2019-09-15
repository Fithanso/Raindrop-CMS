<?php

namespace Raindrop\Service\Plugin;

use Raindrop\Service\AbstractProvider;

use Raindrop\Core\Plugin\Plugin;

class Provider extends AbstractProvider {

	public $serviceName = 'plugin';

	public function init() {

		$plugin = new Plugin($this->di);
		$this->di->set($this->serviceName, $plugin);

		return $this;
	}


}