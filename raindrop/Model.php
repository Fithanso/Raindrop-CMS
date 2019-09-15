<?php

namespace Raindrop;

use Raindrop\Core\Database\QueryBuilder;
use Raindrop\DI\DI;

abstract class Model
{
	/**
	 * @var DI
	 */
	protected $di;

	protected $db;

	protected $config;

	public $queryBuilder;

	/**
	 * Model constructor.
	 * @param $di
	 */
	public function __construct(DI $di)
	{
		$this->di      = $di;
		$this->db      = $this->di->get('db');
		$this->config  = $this->di->get('config');

		$this->queryBuilder = new QueryBuilder();
	}
}