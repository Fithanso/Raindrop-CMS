<?php

namespace Raindrop;

use Raindrop\DI\DI;

use Raindrop\Helper\Cookie;

use Raindrop\Load;

use Raindrop\Core\Database\QueryBuilder;

abstract class Controller {

	/**
	 * @var \Raindrop\DI\DI
	 */
	protected $di;

	protected $db;

	protected $view;

	protected $config;

	/**
	 * @var Request
	 */
	protected $request;

	protected $load;

	protected $model;

	/**
	 * @var \Raindrop\Core\Plugin\Plugin
	 */
	protected $plugin;

	public function __construct(DI $di) {
		$this->di = $di;
		$this->db = $this->di->get('db');
		$this->view = $this->di->get('view');
		$this->config = $this->di->get('config');
		$this->request = $this->di->get('request');
		$this->load = $this->di->get('load');
		$this->model = $this->di->get('model');
		$this->plugin = $this->di->get('plugin');

		$this->initVars();

		$user_hash = Cookie::get('auth_user');

		if($user_hash != null) {
			$queryBuilder = new QueryBuilder();

			$time = time();
			$date = date('Y-m-d H:i:s',$time);

			$sql = $queryBuilder
				->update('user')
				->set(['last_visit' => $date])
				->where('hash', $user_hash)
				->sql();


			$this->db->execute($sql, $queryBuilder->values);
		}

	}

	public function __get($key) {
		return $this->di->get($key);
	}

	/**
	 * @return $this
	 *Function initialises all classes' properties in DI container
	 */
	public function initVars() {
		$vars = array_keys(get_object_vars($this));

		foreach($vars as $var) {
			if($this->di->has($var)) {
				$this->{$var} = $this->di->get($var);
			}
		}
		return $this;
	}

	/**
	 * @return Request
	 */
	public function getRequest() {
		return $this->request;
	}

	/**
	 * @return Core\Plugin\Plugin
	 */
	public function getPlugin() {
		return $this->plugin;
	}

}