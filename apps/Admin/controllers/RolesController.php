<?php

namespace Application\Admin\Controllers;

use Application\Admin\Models\Groups;
use Phalcon\Paginator\Adapter\Model;
use Application\Admin\Models\Rights;

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
	public function saveAction($gid = null){
		if($this->request->isPost()){
			$postData = array(
				'parent_id'=> $this->request->getPost('parent_id'),
				'gname'=> $this->request->getPost('gname'),
				'rightList'=> join(',', array_unique($this->request->getPost('rights'))) 
			);
			if($gid){
				$group = Groups::findFirst(array(
					'gid = :gid:',
					'bind'=> array(
						'gid'=> $gid 
					) 
				));
				if(!$group) $this->displayAjax(false, '未找到您要修改的信息');
			}else{
				$group = new Groups();
			}
			if($group->save($postData) == false) $this->displayAjax(false, join($group->getMessages(), '<br>'));
			$this->displayAjax(true, '', array(
				'redirect_url'=> $this->url->get('Admin/Roles/index') 
			));
		}
		if($gid){
			$group = Groups::findFirst(array(
				'gid = :gid:',
				'bind'=> array(
					'gid'=> $gid 
				) 
			));
			$this->assign('groupRight', explode(',', $group->rightList));
			$this->assign('data', $group);
		}
		// 加载所有分组
		$this->assign('groupList', Groups::find());
		// 加载所有权限资源 
		$rightData = Rights::find();
		$rightArray = array();
		$rightUndefined = array();
		foreach($rightData as $key => $item){
			preg_match('/\[.*?\]/', $item->name, $localPre);
			if(isset($localPre[0])){
				$arrayKey = trim($localPre[0], '[]');
				$rightArray[$arrayKey][] = $item;
			}else{
				$rightUndefined[] = $item;
			}
		}
		$this->assign('rightArray', $rightArray); // []中匹配正确的权限资源
		$this->assign('rightUndefined', $rightUndefined); // 未被定义的权限资源
	}
	public function delAction($gid = null){
		if($gid){
			$group = Groups::findFirst(array(
				'gid = :gid:',
				'bind'=> array(
					'gid'=> $gid 
				) 
			));
			$group->delete();
		}
		$this->displayAjax(true, '删除成功');
	}
}
