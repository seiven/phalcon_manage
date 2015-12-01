<?php
namespace Admin\Models;
use Phalcon\Mvc\Model;
class Users extends Model {
	/**
	 * set table name
	 * @see \Phalcon\Mvc\Model::getSource()
	 */
	public function getSource(){
		return 'cu_admin_user';
	}
}