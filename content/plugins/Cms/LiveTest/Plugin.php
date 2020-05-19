<?php

namespace Plugin\Cms\LiveTest;

/**
 * This class is used as an example.
 * In \Raindrop\Plugin entities you can access DB with QueryBuilder, Router and Customize
 * @package Plugin\LiveTest
 */
class Plugin extends \Raindrop\Plugin {

	public function details() {
		return [
			'name' => 'LiveTest',
			'description' => 'LiveTest plugin',
			'author' => 'Matthew',
		];
	}

	public function init() {
		$this->router->add('test_route', '/test_route/', 'LiveTestController:test', 'GET', 1);
	}
}