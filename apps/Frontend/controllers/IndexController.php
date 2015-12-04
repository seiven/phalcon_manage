<?php

namespace Application\Frontend\Controllers;

class IndexController extends \Phalcon\Mvc\Controller {
	public $layout = 'main';
	public function initialize(){
		$this->view->setTemplateAfter($this->layout);
	}
	public function indexAction(){}
}

