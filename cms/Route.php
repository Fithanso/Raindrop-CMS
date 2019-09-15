<?php
/**
 * List of routes
 */

$this->router->add( 'home', '/', 'HomeController:index' );
$this->router->add( 'user', '/user/(id:int)', 'HomeController:user' );
$this->router->add( 'page', '/page/(segment:any)', 'PageController:show');
//$this->router->add('banned-users', '/admin/prelaunch/create/', 'PreLaunchController:createAdmin', 'POST');