<?php
namespace controllers;
 /**
  * Controller HelloController
  */
class HelloController extends \controllers\ControllerBase{

	public function index(){
		$this->loadView("HelloController/index.html");
	}
}
