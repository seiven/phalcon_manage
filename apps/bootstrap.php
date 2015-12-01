<?php
use Phalcon\Mvc\Application;
use Phalcon\Config\Adapter\Ini as ConfigIni;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Dispatcher;
/**
 * Read the configuration
 */
$config = new ConfigIni(APP_PATH . 'apps/config/config.ini');
if(is_readable(APP_PATH . 'apps/config/config.dev.ini')){
	$override = new ConfigIni(APP_PATH . 'app/config/config.dev.ini');
	$config->merge($override);
}

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
require APP_PATH . 'apps/config/loader.php';

/**
 * Load application services
 */
require APP_PATH . 'apps/config/services.php';

$application = new Application($di);
// 路由
$di->set('router', function () use($application){
	return require __DIR__ . '/config/routes.php';
});
// 注册模块
$application->registerModules(array(
	'Frontend'=> array(
		'className'=> 'Frontend\Module',
		'path'=> APP_PATH . 'apps/Frontend/Module.php' 
	),
	'Admin'=> array(
		'className'=> 'Admin\Module',
		'path'=> APP_PATH . 'apps/Admin/Module.php' 
	) 
));