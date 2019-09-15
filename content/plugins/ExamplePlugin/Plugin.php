<?php

namespace Plugin\ExamplePlugin;

class Plugin extends \Raindrop\Plugin {

	public function details() {
		return [
			'name' => 'Plugin Demo',
			'description' => 'Demonstration plugin',
			'author' => 'Matthew',
			'icon' => 'icon-leaf',

		];
	}

	public function init() {
		// TODO: Implement init() method.
	}
}