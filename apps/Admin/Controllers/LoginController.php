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
	}
}
