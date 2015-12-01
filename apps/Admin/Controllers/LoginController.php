<?php

namespace Admin\Controllers;

use Phalcon\Mvc\Controller;

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
		}
	}
}
