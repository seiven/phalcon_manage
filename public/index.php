<?php
error_reporting(E_ALL & ~E_NOTICE);

$debug = new \Phalcon\Debug();
$debug->listen();

define('APP_PATH', realpath('..') . '/');
define('PUBLIC_PATH', __DIR__);
require APP_PATH . 'apps/bootstrap.php';
echo $application->handle()->getContent();

// try{
// 	define('APP_PATH', realpath('..') . '/');
// 	define('PUBLIC_PATH', __DIR__);
// 	require APP_PATH . 'apps/bootstrap.php';
// 	echo $application->handle()->getContent();
// }catch(Exception $e){
// 	echo $e->getMessage() . '<br>';
// 	echo '<pre>' . $e->getTraceAsString() . '</pre>';
// }
