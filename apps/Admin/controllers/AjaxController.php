<?php

namespace Application\Admin\Controllers;

use Phalcon\Mvc\Controller;
use Application\Admin\Models\Users;
use Application\Admin\Models\Rights;

class AjaxController extends AdminBaseController {
	protected function initialize(){
		parent::initialize();
	}
	/**
	 * 获取controller 下 action
	 */
	function getActAction(){
		$controller = $this->request->get('controller');
		if($controller){
			$controllerList = Rights::getControllers();
			if(isset($controllerList[$controller])) $this->displayAjax(true, '', $controllerList[$controller]);
		}
		$this->displayAjax(true);
	}
}
