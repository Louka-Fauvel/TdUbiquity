<?php
namespace controllers;
 use Ajax\php\ubiquity\JsUtils;
 use Ubiquity\attributes\items\router\Route;

 /**
  * Controller MainController
  * faire la commande pour avoir les dernière version : composer require phpmv/ubiquity:dev-master
  * @property JsUtils $jquery
  */
class MainController extends \controllers\ControllerBase{

    #[Route("_default", name: "home")]
	public function index(){

		$this->loadView("MainController/index.html");
	}
}
