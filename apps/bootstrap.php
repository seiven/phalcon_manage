<?php
use Phalcon\Mvc\Application;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Dispatcher as MvcDispatcher;
use Phalcon\Events\Manager as EventManger;
use Phalcon\DI;
/**
 * Read the configuration
 */
$config = require __DIR__ . '/config/config.php';

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();
$application = new Application($di);

/**
 * We register the events manager
 */
$di->setShared('eventsManager', function (){
	// 创建一个事件管理
	return new EventManger();
});
// 日志
$di->setShared('logger', function (){
	return new \Phalcon\Logger\Adapter\File(__DIR__ . '/logs/' . date('Ymd') . '.log');
});
$di->set('dispatcher', function () use($di){
	$dispatcher = new MvcDispatcher();
	$eventsManager = $di->getShared('eventsManager');
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