<?php
error_reporting(E_ALL & ~E_NOTICE);

try{
	define('APP_PATH', realpath('..') . '/');
	define('PUBLIC_PATH', __DIR__);
	require APP_PATH . 'apps/bootstrap.php';
	echo $application->handle()->getContent();
}catch(Exception $e){
	echo $e->getMessage() . '<br>';
	echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
