<?php
error_reporting(E_ALL);

use Phalcon\Mvc\Application;
use Phalcon\Config\Adapter\Ini as ConfigIni;
try{
	define('APP_PATH', realpath('..') . '/');
	define('PUBLIC_PATH', __DIR__);
	
	/**
     * Read the configuration
     */
	$config = new ConfigIni(APP_PATH . 'apps/config/config.ini');
	if(is_readable(APP_PATH . 'apps/config/config.ini.dev')){
		$override = new ConfigIni(APP_PATH . 'app/config/config.ini.dev');
		$config->merge($override);
	}
	
	/**
     * Auto-loader configuration
     */
	require APP_PATH . 'apps/config/loader.php';
	
	/**
     * Load application services
     */
	require APP_PATH . 'apps/config/services.php';
	
	$application = new Application($di);
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
	echo $application->handle()->getContent();
}catch(Exception $e){
	echo $e->getMessage() . '<br>';
	echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
