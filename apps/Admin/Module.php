<?php

namespace Application\Admin;

use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Config;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\DI;

class Module implements ModuleDefinitionInterface {
	/**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $di
     */
	public function registerAutoloaders(DiInterface $di = null){
		$loader = new Loader();
		
		$loader->registerNamespaces(array(
			'Application\Admin\Controllers'=> __DIR__ . '/controllers/',
			'Application\Admin\Models'=> __DIR__ . '/models/',
			'Application\Admin\Librarys'=> __DIR__ . '/librarys/' 
		));
		$loader->register();
	}
	
	/**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
	public function registerServices(DiInterface $di){
		/**
         * Read common configuration
         */
		$config = $di->has('config') ? $di->getShared('config') : null;
		
		/**
         * Try to load local configuration
         */
		if(file_exists(__DIR__ . '/config/config.php')){
			$override = new Config(include __DIR__ . '/config/config.php');
			
			if($config instanceof Config){
				$config->merge($override);
			}else{
				$config = $override;
			}
		}
		
		/**
         * Setting up the view component
         */
		$view = $di->get('view');
		$view->setViewsDir($config->get('application')->viewsDir);
		$di->set('view', $view);
		// register helper
		$di->setShared('adminHelper', function (){
			return new \Application\Admin\Librarys\voltHelper();
		});
		/**
         * Database connection is created based in the parameters defined in the configuration file
         */
		$di['db'] = function () use($config){
			$config = $config->database->toArray();
			$dbAdapter = '\Phalcon\Db\Adapter\Pdo\\' . $config['adapter'];
			unset($config['adapter']);
			
			return new $dbAdapter($config);
		};
		// add default namespace
		$dispatcher = $di->get('dispatcher');
		$dispatcher->setDefaultNamespace("Application\Admin\Controllers");
		$di->set('dispatcher', $dispatcher);
		// register menu
		$di->set('AdminMenus', function (){
			return require __DIR__ . '/config/menus.php';
		});
	}
}
