<?php

namespace Application\Admin\Models;

use Application\Admin\Models\BaseModel;

class Groups extends BaseModel {
	public  $tableName = 'admin_group';
	/**
     *
     * @var integer
     */
	protected $gid;
	
	/**
     *
     * @var integer
     */
	protected $parent_id;
	
	/**
     *
     * @var string
     */
	protected $gname;
	
	/**
     *
     * @var string
     */
	protected $rightList;
	
	/**
     *
     * @var string
     */
	protected $product_list;
	
	/**
     * Method to set the value of field gid
     *
     * @param integer $gid
     * @return $this
     */
	public function setGid($gid){
		$this->gid = $gid;
		
		return $this;
	}
	
	/**
     * Method to set the value of field parent_id
     *
     * @param integer $parent_id
     * @return $this
     */
	public function setParentId($parent_id){
		$this->parent_id = $parent_id;
		
		return $this;
	}
	
	/**
     * Method to set the value of field gname
     *
     * @param string $gname
     * @return $this
     */
	public function setGname($gname){
		$this->gname = $gname;
		
		return $this;
	}
	
	/**
     * Method to set the value of field rightList
     *
     * @param string $rightList
     * @return $this
     */
	public function setRightList($rightList){
		$this->rightList = $rightList;
		
		return $this;
	}
	
	/**
     * Method to set the value of field product_list
     *
     * @param string $product_list
     * @return $this
     */
	public function setProductList($product_list){
		$this->product_list = $product_list;
		
		return $this;
	}
	
	/**
     * Returns the value of field gid
     *
     * @return integer
     */
	public function getGid(){
		return $this->gid;
	}
	
	/**
     * Returns the value of field parent_id
     *
     * @return integer
     */
	public function getParentId(){
		return $this->parent_id;
	}
	
	/**
     * Returns the value of field gname
     *
     * @return string
     */
	public function getGname(){
		return $this->gname;
	}
	
	/**
     * Returns the value of field rightList
     *
     * @return string
     */
	public function getRightList(){
		return $this->rightList;
	}
	
	/**
     * Returns the value of field product_list
     *
     * @return string
     */
	public function getProductList(){
		return $this->product_list;
	}
	
	/**
     * Returns table name mapped in the model.
     *
     * @return string
     */
	public function getSource(){
		return 'cu_admin_group';
	}
	
	/**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CuAdminGroup[]
     */
	public static function find($parameters = null){
		return parent::find($parameters);
	}
	
	/**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CuAdminGroup
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
			'gid'=> 'gid',
			'parent_id'=> 'parent_id',
			'gname'=> 'gname',
			'rightList'=> 'rightList',
			'product_list'=> 'product_list' 
		);
	}
}
