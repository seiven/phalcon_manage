<?php

namespace Application\Admin\Controllers;

use Application\Admin\Models\Rights;
use Phalcon\DI;

class RightsController extends AdminBaseController {
	public $layout = 'main';
	public function initialize(){
		parent::initialize();
	}
	public function indexAction($page = 1){
		// $parameters["order"] = "id desc";
		$users = Rights::find($parameters);
		$paginator = new \Phalcon\Paginator\Adapter\Model(array(
			'data'=> $users,
			'limit'=> 20,
			'page'=> $page 
		));
		$this->view->page = $paginator->getPaginate();
	}
	public function saveAction($id = null){
		if($this->request->isPost()){
			// 动作集合
			$actionList = $this->request->getPost('actionList');
			$actionList = array_unique($actionList);
			// 转成字符串
			$postData = array(
				'name'=> $this->request->getPost('rightName'),
				'content'=> join(',', $actionList) 
			);
			if($id){
				$rights = Rights::findFirst($id);
				if(!$rights) $this->displayAjax(false, '未找到您要修改的信息');
			}else{
				$rights = new Rights();
			}
			if($rights->save($postData) == false) $this->displayAjax(false, join($rights->getMessages(), '<br>'));
			$this->displayAjax(true, '', array(
				'redirect_url'=> $this->url->get('Admin/Rights/index') 
			));
		}
		if($id){
			$rights = Rights::findFirst($id);
			$this->assign('allowList', explode(',', $rights->content));
			$this->assign('data', $rights);
		}
		$this->assign('controllers', Rights::getControllers());
	}
	public function delAction($id = null){
		if($id){
			$roles = Rights::findFirst($id);
			$roles->delete();
		}
		$this->displayAjax(true, '删除成功');
	}
}
