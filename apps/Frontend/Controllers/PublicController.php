<?php
use Frontend\Controllers;
class PublicController extends BaseController {
	public function err404Action(){
		echo 404;
		exit();
	}
}