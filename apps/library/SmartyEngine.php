<?php
include_once __DIR__ . '/Smarty/Smarty.class.php';
class SmartyEngine extends \Phalcon\Mvc\View\Engine implements Phalcon\Mvc\View\EngineInterface {
	protected $_smarty;
	protected $_params;
	public function __construct(Phalcon\Mvc\View $view, Phalcon\DI $di){
		$this->_smarty = new Smarty();
		$this->_smarty->template_dir = '.';
		$this->_smarty->compile_dir = PUBLIC_PATH . '/__runtime/script';
		// $this->_smarty->config_dir = SMARTY_DIR . 'configs';
		$this->_smarty->cache_dir = PUBLIC_PATH . '/__runtime/cache';
		$this->_smarty->caching = false;
		$this->_smarty->debugging = true;
		$this->_smarty->left_delimiter = '<{';
		$this->_smarty->right_delimiter = '}>';
		$this->_smarty->cache_lifetime = 100;
		
		parent::__construct($view, $di);
	}
	public function render($path, $params, $mustClean = NULL){
		$params['page_content'] = $this->_view->getContent();
		foreach($params as $key => $value){
			$this->_smarty->assign($key, $value);
		}
		echo $path;
		$this->_view->setContent($this->_smarty->fetch($path));
	}
}