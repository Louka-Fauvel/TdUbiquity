<?php
namespace controllers;
 use Ajax\php\ubiquity\JsUtils;
 use Ubiquity\attributes\items\router\Route;
 use Ubiquity\controllers\auth\AuthController;
 use Ubiquity\controllers\auth\WithAuthTrait;

 /**
  * Controller MainController
  * faire la commande pour avoir les dernière version : composer require phpmv/ubiquity:dev-master
  * faire la commande pour autoload les pages : npm install -g livereload
  * @property JsUtils $jquery
  */
class MainController extends \controllers\ControllerBase{
    use WithAuthTrait;
    #[Route("_default", name: "home")]
	public function index(){

		$this->loadView("MainController/index.html");
	}

    protected function getAuthController(): AuthController
    {
        return new MyAuth($this);
    }
}
