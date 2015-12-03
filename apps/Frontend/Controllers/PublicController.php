<?php
use Application\Frontend\Controllers\BaseController;
class PublicController extends BaseController {
	public function err404Action(){
		echo 404;
		exit();
	}
}