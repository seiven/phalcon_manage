<?php

namespace Admin;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;

class Module {
	/**
     * 注册自定义加载器
     */
	public function registerAutoloaders($di){
		$loader = new Loader();
		$loader->registerNamespaces(array(
			'Admin\Controllers'=> __DIR__ . '/Controllers/',
			'Admin\Models'=> __DIR__ . '/Models/' 
		));
		
		$loader->register();
	}
	
	/**
     * 注册自定义服务
     */
	public function registerServices($di){
		// Registering a dispatcher
		$di->set('dispatcher', function (){
			$dispatcher = new Dispatcher();
			$dispatcher->setDefaultNamespace("Admin\Controllers");
			return $dispatcher;
		});
		
		// Registering the view component
		$di->set('view', function (){
			$view = new View();
			$view->setViewsDir(__DIR__ . '/Views/');
			$view->registerEngines(array(
				".html"=> 'SmartyEngine' 
			));
			return $view;
		});
	}
}