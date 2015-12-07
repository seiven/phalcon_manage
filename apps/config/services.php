<?php
use Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaData;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\DI;
use Phalcon\Mvc\Application;

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
	$dbAdapter = '\Phalcon\Db\Adapter\Pdo\\' . $config['adapter'];
	unset($config['adapter']);
	$connection = new $dbAdapter($config);
	// 监听数据库
	$eventsManager = DI::getDefault()->getShared('eventsManager');
	$eventsManager->attach('db:beforeQuery', function ($event, $connection){
		$logger = DI::getDefault()->getShared('logger');
		$logger->log($connection->getSQLStatement(), \Phalcon\Logger::INFO);
	});
	$connection->setEventsManager($eventsManager);
	return $connection;
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function (){
	$session = new SessionAdapter();
	$session->start();
	return $session;
});

$di->set('view', function (){
	$view = new View();
	$view->registerEngines(array(
		".html"=> 'volt' 
	));
	return $view;
});

/**
 * Setting up volt
 */
$di->set('volt', function ($view, $di){
	$volt = new VoltEngine($view, $di);
	$volt->setOptions(array(
		"compiledPath"=> function ($templatePath){
			$dirName = str_replace('\\', '_', str_replace('/', '_', dirname(trim($templatePath, APP_PATH))));
			$cachePath = PUBLIC_PATH . '/__runtime/cache';
			return $cachePath . '/' . $dirName . '_' . basename($templatePath) . '.php';
		} 
	));
	// register function
	$compiler = $volt->getCompiler();
	$compiler->addFunction('md5', 'md5');
	$compiler->addFunction('replace', 'str_replace');
	$compiler->addFunction('in_array', 'in_array');
	return $volt;
}, true);
// set config
$di->set('config', function () use($config){
	return $config;
});