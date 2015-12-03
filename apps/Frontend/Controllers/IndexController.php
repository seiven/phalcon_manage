<?php

namespace Application\Frontend\Controllers;

class IndexController extends BaseController {
	public $layout = 'main';
	function initialize(){
		parent::initialize();
	}
	public function indexAction(){
		echo 'frontend/index';
	}
}
