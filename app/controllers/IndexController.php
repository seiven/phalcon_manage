<?php
class IndexController extends BaseController {
	public $layout = 'main';
	public function initialize(){
		parent::initialize();
	}
	public function indexAction(){
		if(!$this->request->isPost()){
			$this->flash->notice('This is a sample application of the Phalcon Framework.
                Please don\'t provide us any personal information. Thanks');
		}
	}
	public function abcAction()
	{
		echo 1;
	}
}
