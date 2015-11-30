<?php
use Phalcon\Mvc\Router;

// Create the router
$router = new Router();
$router->setDefaultModule("Frontend");
// Define a route
$router->add(':controller/:action/:params', array(
	'controller'=> 1,
	'action'=> 2,
	'params'=> 3 
));
// 默认
$router->add('/', array(
	'controller'=> 'index',
	'action'=> 'index' 
));
$router->notFound(array(
	'controller'=> 'public',
	'action'=> 'err404' 
));
return $router;