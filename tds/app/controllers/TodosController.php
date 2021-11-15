<?php
namespace controllers;
 use Ubiquity\attributes\items\router\Route;

 /**
  * Controller TodosController
  */
class TodosController extends \controllers\ControllerBase{
    #[Route('_default')]
	public function index(){
		$this->loadView("TodosController/index.html");
	}
}
