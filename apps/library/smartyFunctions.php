<?php
use Phalcon\Mvc\Url;
class smartyFunctions {
	/**
	 * 创建url地址
	 * @param unknown $params
	 */
	static function createUrl($params){
		$urlObj = new Url();
		$url = '';
		if (!isset($params['uri']) || !$params['uri']) $params['uri'] = '/';

		return $urlObj->get($params['uri'],$params['params']);
	}
}
