<?php
/**
 * List of routes
 */
$this->router->add( 'home', '/', 'HomeController:index' );
$this->router->add( 'page', '/page/(segment:any)', 'PageController:show');
$this->router->add( 'post', '/post/(id:int)', 'PostController:show');
