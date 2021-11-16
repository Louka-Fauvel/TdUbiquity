<?php
namespace controllers;
use Ubiquity\attributes\items\router\Get;
use Ubiquity\attributes\items\router\Post;
use Ubiquity\attributes\items\router\Route;
use Ubiquity\utils\http\URequest;
use Ubiquity\utils\http\USession;

/**
  * Controller TodosController
  * Faire composer install
  */
#[Route('/todos/')]
class TodosController extends \controllers\ControllerBase{

    const CACHE_KEY = 'datas/lists/';
    const EMPTY_LIST_ID='not saved';
    const LIST_SESSION_KEY='list';
    const ACTIVE_LIST_SESSION_KEY='active-list';

    #[Route('#/_default',name: "home")]
	public function index(){

        $allList=USession::get(self::ACTIVE_LIST_SESSION_KEY, []);
        var_dump($allList);
		$this->loadView("TodosController/index.html", ['allList'=>$allList]);

	}

	#[Post(path: "add",name: "todos.add")]
	public function addElement(){

        USession::addValueToArray('active-list', URequest::post('objectList'));
        $this->index();

	}


	#[Get(path: "delete/{index}",name: "todos.delete")]
	public function deleteElement($index){

        $list=USession::get(self::ACTIVE_LIST_SESSION_KEY);
        unset($list[$index]);
        USession::set(self::ACTIVE_LIST_SESSION_KEY, \array_values($list));
		$this->index();

	}


	#[Post(path: "edit/{index}",name: "todos.edit")]
	public function editElement($index){
		


	}


	#[Get(path: "loadList/{uniqid}",name: "todos.loadList")]
	public function loadList($uniqid){
		


	}


	#[Post(path: "loadList",name: "todos.loadListPost")]
	public function loadListFromForm(){
		


	}


	#[Get(path: "new/{force}",name: "todos.new")]
	public function newlist($force=false){
		


	}


	#[Get(path: "saveList",name: "todos.save")]
	public function saveList(){
		


	}

}
