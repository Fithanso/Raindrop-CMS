<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/Function.php';

use Raindrop\Cms;
use Raindrop\DI\DI;
use Raindrop\Service\Database\Provider;

/**
 * These aliases are used in templates. Aliases for Page, Post models are defined within Controllers in cms/...
 */

class_alias('Raindrop\\Core\\Template\\Asset', 'Asset');
class_alias('Raindrop\\Core\\Template\\Theme', 'Theme');
class_alias('Raindrop\\Core\\Template\\Setting', 'Setting');
class_alias('Raindrop\\Core\\Template\\Menu', 'Menu');
class_alias('Raindrop\\Core\\Customize\\Customize', 'Customize');
class_alias('Raindrop\\Core\\Template\\Paginator', 'Paginator');


try {
	//Dependency injection
	$di = new DI();

	$services = require __DIR__.'/Config/Service.php';

	//Init services
	foreach ($services as $service) {
		$provider = new $service($di);
		$provider->init();
	}

	$cms = new Cms($di);
	$cms->run();
}catch(\ErrorException $e) {
	echo $e->getMessage();
}

