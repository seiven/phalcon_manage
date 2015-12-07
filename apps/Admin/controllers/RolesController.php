<?php

namespace Application\Admin\Controllers;

use Application\Admin\Models\Groups;
use Phalcon\Paginator\Adapter\Model;

class RolesController extends AdminBaseController {
	public $layout = 'main';
	public function initialize(){
		parent::initialize();
	}
	public function indexAction($page = 1){
		$parameters["order"] = "gid desc";
		$users = Groups::find($parameters);
		$paginator = new Model(array(
			'data'=> $users,
			'limit'=> 20,
			'page'=> $page 
		));
		$this->view->page = $paginator->getPaginate();
	}
	public function saveAction(){}
	public function delAction($id = null){
		if($id){
			$roles = Groups::findFirst(array(
				'gid'=> $id 
			));
			$roles->delete();
		}
		$this->displayAjax(true, '删除成功');
	}
}
