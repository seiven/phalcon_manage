<?php
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Application;

// Create the router
$router = new Router();
$router->setDefaultModule("Frontend");
// fronted
$router->add(':controller/:action/:params', array(
	'controller'=> 1,
	'action'=> 2,
	'params'=> 3 
));
// 多模块
foreach($application->getModules() as $key => $module){
	$router->add('/' . $key . '/:params', array(
		'module'=> $key,
		'controller'=> 'index',
		'action'=> 'index',
		'params'=> 1 
	))->setName($key);
	$router->add('/' . $key . '/:controller/:params', array(
		'module'=> $key,
		'controller'=> 1,
		'action'=> 'index',
		'params'=> 2 
	));
	$router->add('/' . $key . '/:controller/:action/:params', array(
		'module'=> $key,
		'controller'=> 1,
		'action'=> 2,
		'params'=> 3 
	));
}
// default
$router->add('/', array(
	'controller'=> 'index',
	'action'=> 'index',
	'module'=> 'Frontend' 
));
$router->notFound(array(
	'namespace'=> 'Frontend\Controller',
	'module'=> 'Frontend',
	'controller'=> 'public',
	'action'=> 'err404' 
));
return $router;