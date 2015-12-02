<?php

namespace Admin\Models;

use Phalcon\Mvc\Model;
use Phalcon\DI;
class BaseModel extends Model {
	public $tableName;
	/**
	 * set table name
	 * @see \Phalcon\Mvc\Model::getSource()
	 */
	public function getSource(){
		return DI::getDefault()->get('config')->database->tablePrex . $this->tableName;
	}
}