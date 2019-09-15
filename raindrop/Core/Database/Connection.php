<?php

namespace Raindrop\Core\Database;

use PDO;
use Raindrop\Core\Config\Config;

class Connection {

	private $link;

	private $queryBuilder;

	public function __construct() {
		$this->connect();

	}

	/**
	 * @return $this
	 */
	public function connect() {

		$config = Config::group('database');


		$dsn = 'mysql:host='.$config['host'].';dbname='.$config['db_name'].';charset='.$config['charset'];

		$this->link = new PDO($dsn, $config['username'], $config['password']);

		return $this;
	}


	/**
	 * @param $sql
	 * @param array $values
	 *
	 * @return mixed
	 */
	public function execute($sql, $values = []) {

		list($sql, $values) = explode(':',$sql,2);
		$values = unserialize($values);

		$sth = $this->link->prepare($sql);

		return $sth->execute($values);
	}


	/**
	 * Function gets values instantly with sql string, then splits them
	 * @param $sql
	 * @param array $values
	 * @param int $statement
	 *
	 * @return array
	 */
	public function query($sql, $values = [], $statement = PDO::FETCH_OBJ) {

		list($sql, $values) = explode(':',$sql,2);
		$values = unserialize($values);

		$sth = $this->link->prepare($sql);

		$sth->execute($values);

		$result = $sth->fetchAll($statement);

		if($result === false) {

			return [];
		}

		return $result;
	}

	public function simpleQuery($sql) {
		$stmt = $this->link->query($sql);
		return $stmt;
	}


	public function lastInsertId() {
		return $this->link->lastInsertId();
	}

	/**
	 * @return QueryBuilder
	 */

}