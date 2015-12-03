<?php
use Phalcon\Mvc\Application;
use Phalcon\Config\Adapter\Ini as ConfigIni;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Dispatcher;
/**
 * Read the configuration
 */
$config = require __DIR__ . '/config/config.php';

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * We register the events manager
 */
$di->set('dispatcher', function () use($di){
	$dispatcher = new Dispatcher();
	return $dispatcher;
});
/**
 * Auto-loader configuration
 */
require __DIR__ . '/config/loader.php';

/**
 * Load application services
 */
require __DIR__ . '/config/services.php';

$application = new Application($di);

// register moudles
$modules = require __DIR__ . '/config/modules.php';
foreach($modules as $m){
	$_modules[$m] = array(
		'className'=> "Application\\{$m}\Module",
		'path'=> __DIR__ . "/{$m}/Module.php" 
	);
}
$application->registerModules($_modules);
// router
$di->set('router', function () use($application){
	return require __DIR__ . '/config/routes.php';
});