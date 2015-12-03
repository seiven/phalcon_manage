<?php

namespace Admin\Controllers;

use Phalcon\Mvc\Controller;

class AdminBaseController extends Controller {
	public $layout = 'main';
	public $_user = null;
	protected function initialize(){
		// load layout
		// load line userinfo
		$adminUser = $this->session->get('adminAuth');
		if($adminUser) $this->_user = $adminUser;
		// check user login
		$this->isLogin();
		// load auto assgin config and assgin
		$viewAutoAssginConfig = $this->config->adminViewAutoAssgin;
		foreach($viewAutoAssginConfig as $key => $val){
			$this->assign($key, $val);
		}
		// load this uri controller action moudle
		$this->assign('controller', $this->dispatcher->getControllerName());
		$this->assign('action', $this->dispatcher->getActionName());
		// load menus
		$this->assign('AdminMenus', $this->di->get('AdminMenus'));
	}
	// set var to template
	protected function assign($key, $value){
		$this->view->setVar($key, $value);
	}
	/**
	 * redirect other action
	 * @param unknown $uri
	 */
	protected function forward($uri){
		$uriParts = explode('/', $uri);
		$params = array_slice($uriParts, 2);
		return $this->dispatcher->forward(array(
			'controller'=> $uriParts[0],
			'action'=> $uriParts[1],
			'params'=> $params 
		));
	}
	/**
	 * user login redirect
	 */
	protected function isLogin(){
		if(is_null($this->_user) && $this->dispatcher->getControllerName() != 'Login'){
			// no login
			$this->response->redirect('/Admin/Login');
		}
	}
	/**
	 * claer template after clear layout
	 */
	protected function clearLayout(){
		$this->view->cleanTemplateAfter();
	}
}
