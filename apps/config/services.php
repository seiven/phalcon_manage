<?php
use Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaData;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Events\Manager as EventsManager;

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function () use($config){
	$url = new UrlProvider();
	$url->setBaseUri($config->application->baseUri);
	return $url;
});
/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->set('db', function () use($config){
	$config = $config->get('database')->toArray();
	
	$dbClass = 'Phalcon\Db\Adapter\Pdo\\' . $config['adapter'];
	unset($config['adapter']);
	
	return new $dbClass($config);
});

/**
 * Start the session the first time some component request the session service
 */
$di->set('session', function (){
	$session = new SessionAdapter();
	$session->start();
	return $session;
});
/**
 * Register a user component
 */
$di->set('AdminMenus', function (){
	return new AdminMenus();
});

$di->set('view', function (){
	$view = new View();
	$view->registerEngines(array(
		".html"=> 'Phalcon\Mvc\View\Engine\Volt' 
	));
	return $view;
});
// 配置
$di->set('config', function () use($config){
	return $config;
});