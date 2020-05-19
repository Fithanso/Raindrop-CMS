<?php

namespace Raindrop;

use Raindrop\Core\Database\Connection;
use Raindrop\Core\Router\Router;
use Raindrop\DI\DI;

abstract class Plugin {

	protected $di;

	protected $db;

	protected $router;

	public function __construct(DI $di) {
		$this->di = $di;
		$this->db = $this->di->get('db');
		$this->router = $this->di->get('router');
		$this->customize = $this->di->get('customize');
	}


	abstract public function details();

	abstract public function init();


	public function getDI() {
		return $this->di;
	}

	/**
	 * @return mixed
	 */
	public function getDb() {
		return $this->db;
	}

	/**
	 * @return mixed
	 */
	public function getRouter() {
		return $this->router;
	}
}