<?php

namespace Raindrop\Service;

abstract class AbstractProvider {

	/**
	 * @var \Raindrop\DI\DI;
	 *
	 */
	protected $di;

	public function __construct(\Raindrop\DI\DI $di) {
		$this->di = $di;
	}

	/**
	 * @return mixed
	 */
	abstract function init();
}