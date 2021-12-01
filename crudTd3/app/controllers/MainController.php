<?php
namespace controllers;
 use Ajax\php\ubiquity\JsUtils;
 use services\dao\OrgaRepository;
 use Ubiquity\attributes\items\di\Autowired;
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

    #[Autowired]
    private OrgaRepository $repo;

    public function setRepo(OrgaRepository $repo): void {

        $this->repo = $repo;
    }

    #[Route("_default", name: "home")]
	public function index(){

		$this->loadView("MainController/index.html");
        $this->getAuthController()->_getActiveUser()->getOrganization();
        var_dump($this->getAuthController()->_getActiveUser()->getOrganization()->getName());
        
        /*$bt = $this->semantic()->htmlButton('users-bt', 'Display users');
        $bt->addIcon('users');
        $bt->getOnClick(Router::path('display.compo.users'), '#users', [
            'hasLoader' => 'internal'
        ]);
        $this->jquery->renderDefaultView();*/

	}

    protected function getAuthController(): AuthController
    {

        return new MyAuth($this);

    }

    private function semantic()
    {

        return $this->jquery->semantic();
    }
}
