<?php
use Phalcon\Mvc\Controller;
class BaseController extends Controller {
	public $layout = 'main';
	protected function initialize(){
		$this->view->setTemplateAfter($this->layout);
	}
	protected function forward($uri){
		$uriParts = explode('/', $uri);
		$params = array_slice($uriParts, 2);
		return $this->dispatcher->forward(array(
			'controller'=> $uriParts[0],
			'action'=> $uriParts[1],
			'params'=> $params 
		));
	}
}
