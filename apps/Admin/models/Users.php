<?php

namespace Application\Admin\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Validator\Email;

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
	/**
	 *
	 * @var integer
	 */
	public $id;
	
	/**
	 *
	 * @var string
	 */
	public $username;
	
	/**
	 *
	 * @var string
	 */
	public $password;
	
	/**
	 *
	 * @var string
	 */
	public $salt;
	
	/**
	 *
	 * @var string
	 */
	public $email;
	
	/**
	 *
	 * @var string
	 */
	public $createTime;
	
	/**
	 *
	 * @var string
	 */
	public $lastTime;
	
	/**
	 *
	 * @var string
	 */
	public $lastIp;
	
	/**
	 *
	 * @var integer
	 */
	public $status;
	
	/**
	 *
	 * @var integer
	 */
	public $groupId;
	
	/**
	 *
	 * @var string
	 */
	public $phone;
	
	/**
	 *
	 * @var string
	 */
	public $saveLog;
	
	/**
	 *
	 * @var string
	 */
	public $truename;
	
	/**
	 *
	 * @var string
	 */
	public $avatar;
	/**
	 * Validations and business logic
	 *
	 * @return boolean
	 */
	public function validation(){
		return true;
		$this->validate(new Email(array(
			'field'=> 'email',
			'required'=> true 
		)));
		
		if($this->validationHasFailed() == true){
			return false;
		}
	}
	/**
	 * Independent Column Mapping.
	 * Keys are the real names in the table and the values their names in the application
	 *
	 * @return array
	 */
	public function columnMap(){
		return array(
			'id'=> 'id',
			'username'=> 'username',
			'password'=> 'password',
			'salt'=> 'salt',
			'email'=> 'email',
			'createTime'=> 'createTime',
			'lastTime'=> 'lastTime',
			'lastIp'=> 'lastIp',
			'status'=> 'status',
			'groupId'=> 'groupId',
			'phone'=> 'phone',
			'saveLog'=> 'saveLog',
			'truename'=> 'truename',
			'avatar'=> 'avatar' 
		);
	}
}