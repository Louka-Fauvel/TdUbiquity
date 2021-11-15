<?php
namespace controllers;
use Ajax\JsUtils;
use Ubiquity\attributes\items\router\Get;
use Ubiquity\attributes\items\router\Post;
use Ubiquity\attributes\items\router\Route;
use Ubiquity\controllers\Router;
use Ubiquity\utils\http\URequest;
use Ubiquity\utils\http\USession;

/**
  * Controller TestController
  * @property  JsUtils $jquery
  */
class TestController extends \controllers\ControllerBase{

    #[Route('_default')]
	public function index(){
        $this->jquery->getHref('a', parameters: ['hasLoader'=>false, 'historize'=>false]);
		$this->jquery->renderDefaultView();
	}

	public function hello($msg='Hello World !'){
		
		$this->loadView('TestController/hello.html', ['message'=>$msg]);

	}

	#[Get(path: "msg/{msg}",name: "test.message")]
	public function msgAction($msg){

        $countries=USession::get('countries', []);
		$this->loadView('TestController/message.html', ['message'=>$msg, 'countries'=>$countries]);

	}

	#[Route(path: "new/msg/{msg}/{type}",name: "test.newMessageAction")]
	public function newMessageAction($msg,$type){
		
		$this->loadView('TestController/newMessageAction.html');

	}

	#[Get(path: "addCountry",name: "test.formNewCountryAction")]
	public function formNewCountryAction(){

        $this->jquery->postFormOnClick('button', Router::path('test.addCountry'), 'frm', '._content', ['hasLoader'=>'internal']);
		$this->jquery->renderView('TestController/formNewCountryAction.html');

	}


	#[Route(path: "test/addCountry",name: "test.addCountry")]
	public function addCountry(){

        USession::addValueToArray('countries', URequest::post('country'));
        $this->msgAction('Pays ajouté');

	}

}
