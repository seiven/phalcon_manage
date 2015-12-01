<?php
use Phalcon\Mvc\User\Component;
class AdminMenus extends Component {
	/**
	 * 获取菜单列表
	 */
	public function getAll(){
		return array(
			'系统用户'=> array(
				'name'=> 'adminRole',
				'icon'=> 'icon-desktop',
				'list'=> array(
					'角色管理'=> array(
						'c'=> 'adminRole',
						'a'=> 'index',
						'icon'=> '' 
					),
					'用户管理'=> array(
						'c'=> 'adminRole',
						'a'=> 'userList',
						'icon'=> '' 
					),
					'权限资源'=> array(
						'c'=> 'adminRole',
						'a'=> 'rightList',
						'icon'=> '' 
					) 
				) 
			) 
		);
	}
}