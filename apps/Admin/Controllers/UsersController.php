<?php

/**
 * admin user
 */
namespace Admin\Controllers;

use Admin\Models\Users;
use Phalcon\Paginator\Adapter\Model;

class UsersController extends AdminBaseController {
	public $layout = 'main';
	public function initialize(){
		parent::initialize();
	}
	/**
	 * user list
	 */
	public function indexAction(){
		$page = $this->request->getQuery('page', 'int', 1);
		$users = Users::find();
		$paginator = new Model(array(
			'data'=> $users,
			'limit'=> 20,
			'page'=> $page 
		));
		$this->view->page = $paginator->getPaginate();
	}
	/**
	 * set password
	 */
	public function setpwdAction(){}
}
