<?php

namespace Application\Admin\Models;

use Application\Admin\Models\BaseModel;
use Phalcon\DI;

class Rights extends BaseModel {
	public $tableName = 'admin_rights';
	/**
     *
     * @var integer
     */
	protected $id;
	
	/**
     *
     * @var string
     */
	protected $name;
	
	/**
     *
     * @var string
     */
	protected $content;
	
	/**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
	public function setId($id){
		$this->id = $id;
		
		return $this;
	}
	
	/**
     * Method to set the value of field name
     *
     * @param string $name
     * @return $this
     */
	public function setName($name){
		$this->name = $name;
		
		return $this;
	}
	
	/**
     * Method to set the value of field content
     *
     * @param string $content
     * @return $this
     */
	public function setContent($content){
		$this->content = $content;
		
		return $this;
	}
	
	/**
     * Returns the value of field id
     *
     * @return integer
     */
	public function getId(){
		return $this->id;
	}
	
	/**
     * Returns the value of field name
     *
     * @return string
     */
	public function getName(){
		return $this->name;
	}
	
	/**
     * Returns the value of field content
     *
     * @return string
     */
	public function getContent(){
		return $this->content;
	}
	
	/**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CuAdminRights[]
     */
	public static function find($parameters = null){
		return parent::find($parameters);
	}
	
	/**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CuAdminRights
     */
	public static function findFirst($parameters = null){
		return parent::findFirst($parameters);
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
			'name'=> 'name',
			'content'=> 'content' 
		);
	}
	/**
	 * 获得所有controller,action
	 * @return array
	 */
	static function getControllers(){
		$config = DI::getDefault()->get('config');
		$controllerList = scandir($config->application->controllersDir);
		$controller = array();
		foreach($controllerList as $file){
			if(!in_array($file, array(
				'.',
				'..',
				'AjaxController.php',
				'LoginController.php' 
			))){
				require_once $config->application->controllersDir . '/' . $file;
				$class = '\Application\Admin\Controllers\\' . trim($file, '.php');
				$methods = get_class_methods(new $class());
				foreach($methods as $a){
					if(!in_array($a, array(
						'setDI',
						'getDI',
						'setEventsManager',
						'getEventsManager',
						'__construct',
						'__get',
						'initialize' 
					))){
						
						$controller[trim($file, '.php')][] = rtrim($a, 'Action');
					}
				}
			}
		}
		return $controller;
	}
}
