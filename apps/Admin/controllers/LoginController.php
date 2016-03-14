<?php

namespace Application\Admin\Controllers;

use Phalcon\Mvc\Controller;
use Application\Admin\Models\Users;

class LoginController extends AdminBaseController {
	protected function initialize(){
		parent::initialize();
	}
	/**
	 * user login action
	 */
	public function indexAction(){
		// clear layout
		$this->clearLayout();
		if($this->request->isPost()){
			// submit login
			$username = $this->request->getPost('username', 'trim');
			$password = $this->request->getPost('password', 'trim');
			$isremember = $this->request->getPost('isremember', 'trim');
			$user = Users::getUserByName($username);
			if($user){
				// account info ok
				if($user->password == md5(md5($password) . $user->salt)){
					// password is right
					if($user->status == 1){
						// allow login
						$this->session->set('adminAuth', serialize($user));
						return $this->response->redirect('/Admin');
					}else{
						$this->assign('errorMessage', '您的账户被锁定');
					}
				}else{
					// password fail
					$this->assign('errorMessage', '您的密码错误');
				}
			}else{
				// not fond this account
				$this->assign('errorMessage', '您的账户未找到');
			}
		}
	}
	/**
	 * login out
	 */
	public function outAction(){
		$this->session->remove('adminAuth');
		return $this->response->redirect('/Admin/Login/index');
	}
}
