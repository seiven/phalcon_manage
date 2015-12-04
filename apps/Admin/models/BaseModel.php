<?php

namespace Application\Admin\Models;

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
	/**
	 * 保存数据
	 * @param array $attr
	 * @param object $o
	 * @return array
	 */
	static function dataSave($attr, $o = false){
		$return = array(
			'status'=> false,
			'message'=> null 
		);
		$columnMap = null;
		if(!$o){
			// 插入
			$o = new self();
			if($o->create($attr) == false){
				$return['message'] = join($o->getMessages(), '<br>');
			}
		}else{
			// 更新
			if($o->update($attr) == false){
				$return['message'] = join($o->getMessages(), '<br>');
			}
		}
		if(is_null($return['message'])) $return['status'] = true;
		return $return;
	}
}