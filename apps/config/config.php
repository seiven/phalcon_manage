<?php
return new \Phalcon\Config(array(
	'database'=> array(
		'adapter'=> 'Mysql',
		'host'=> '10.10.20.202',
		'username'=> 'web_devuser',
		'password'=> 'chen18li',
		'dbname'=> 'customer_skymoons_com',
		'charset'=> 'utf8',
		'tablePrex'=> 'cu_' 
	),
	'application'=> array(
		'controllersDir'=> __DIR__ . '/../controllers/',
		'modelsDir'=> __DIR__ . '/../models/',
		'modulesDir'=> __DIR__ . '/../',
		'migrationsDir'=> __DIR__ . '/../migrations/',
		'viewsDir'=> __DIR__ . '/../views/',
		'pluginsDir'=> __DIR__ . '/../plugins/',
		'libraryDir'=> __DIR__ . '/../library/',
		'baseUri'=> '/' 
	),
	'adminViewAutoAssgin'=> array(
		'siteName'=> 'back manage',
	) 
));
