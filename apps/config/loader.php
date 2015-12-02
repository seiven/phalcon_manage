<?php
$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */

$loader->registerDirs(array(
	APP_PATH . "apps/library/" 
));
// register autoloader
$loader->register();
