<?php

namespace Admin\Controllers;

class IndexController extends AdminBaseController {
	public $layout = 'main';
	public function initialize(){
		$this->view->setTemplateAfter($this->layout);
		parent::initialize();
	}
	public function indexAction(){}
}
