<?php

namespace Application\Admin\Models;

use Phalcon\Mvc\Model;

class Users extends BaseModel {
	public $tableName = 'admin_user';
	
	/**
	 * get user by username
	 * @param string $username
	 */
	static function getUserByName($username){
		return Users::findFirst(array(
			"username = :username: ",
			'bind'=> array(
				'username'=> $username 
			) 
		));
	}
	static function  beforeUpdate()
	{
		
	}
}