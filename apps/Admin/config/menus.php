<?php
use Phalcon\DI;
return array(
	'系统用户'=> array(
		'icon'=> 'icon-desktop',
		'url'=> DI::getDefault()->get('url')->get('/Admin/index/main'),
		'list'=> array(
			'角色管理'=> array(
				'url'=> DI::getDefault()->get('url')->get('/Admin/Roles/index'),
				'icon'=> '' 
			),
			'用户管理'=> array(
				'url'=> DI::getDefault()->get('url')->get('/Admin/Users/index'),
				'icon'=> '' 
			),
			'权限资源'=> array(
				'url'=> DI::getDefault()->get('url')->get('/Admin/Rights/index'),
				'icon'=> '' 
			) 
		) 
	) 
); 