<?php

namespace Application\Frontend\Controllers;

use Phalcon\Mvc\Controller;

class BaseController extends Controller {
	public $layout = 'main';
	protected function initialize(){
		// use layout
		if(is_null($this->layout)){
			$this->view->cleanTemplateAfter();
		}else{
			$this->view->setTemplateAfter($this->layout);
		}
	}
}