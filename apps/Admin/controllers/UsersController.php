<?php

/**
 * admin user
 */
namespace Application\Admin\Controllers;

use Application\Admin\Models\Users;
use Phalcon\Paginator\Adapter\Model;
use Application\Admin\Models\Groups;

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
		$parameters["order"] = "id";
		$users = Users::find($parameters);
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
	/**
	 * 保存管理员用户
	 */
	public function saveAction(){
		$id = $this->dispatcher->getParam('id');
		$isNew = true;
		if(!empty($id)) $isNew = false; // update
		if($this->request->isPost()){
			$postData = array(
				'username'=> $this->request->getPost('username'),
				'password'=> $this->request->getPost('password'),
				'email'=> $this->request->getPost('email'),
				'phone'=> $this->request->getPost('phone'),
				'createTime'=> time(),
				'status'=> $this->request->getPost('status', 'int'),
				'groupId'=> $this->request->getPost('groupId', 'int'),
				'truename'=> $this->request->getPost('truename') 
			);
			
			if(empty($postData['groupId'])){
				$this->displayAjax(false, '请选择用户所属用户角色分组');
			}elseif(is_null($postData['password']) && $isNew){
				// 新增无密码
				$this->displayAjax(false, '新增用户必须填入密码');
			}
			
			if(!empty($postData['password'])){
				$postData['salt'] = rand(100000, 999999);
				$postData['password'] = md5(md5($postData['password']) . $postData['salt']);
			}
			if($isNew){
				// 新增
				// 判断账户是否存在
				$hasUser = Users::count(array(
					"username = :username: ",
					'bind'=> array(
						'username'=> $username 
					) 
				));
				if($hasUser) $this->displayAjax(false, '用户已存在无法新增!');
				$user = new Users();
			}else{
				// 更新
				$user = Users::findFirst($id);
				if(!$user) $this->displayAjax(false, '您要更新的账户不存在!');
			}
			if($user->save($postData) == false) $this->displayAjax(false, join($user->getMessages(), '<br>'));
			$this->displayAjax(true);
		}
		$this->assign('id', $id);
		if(!$isNew) $this->assign('model', Users::findFirst($id));
		$this->assign('groups', Groups::find());
	}
}
