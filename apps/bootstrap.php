<?php
use Phalcon\Mvc\Application;
use Phalcon\Config\Adapter\Ini as ConfigIni;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Dispatcher as MvcDispatcher;
use Phalcon\Events\Manager as EventManger;
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
	// 创建一个事件管理
	$eventsManager = new EventManger();
	
	// 附上一个侦听者
	$eventsManager->attach("dispatch:beforeDispatchLoop", function ($event, $dispatcher){
		
		$keyParams = array();
		$params = $dispatcher->getParams();
		
		// 用奇数参数作key，用偶数作值
		foreach($params as $number => $value){
			if($number & 1){
				$keyParams[$params[$number - 1]] = $value;
			}
		}
		
		// 重写参数
		$dispatcher->setParams($keyParams);
	});
	
	$dispatcher = new MvcDispatcher();
	$dispatcher->setEventsManager($eventsManager);
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