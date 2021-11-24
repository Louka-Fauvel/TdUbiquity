<?php
namespace controllers;
use controllers\crud\datas\IndexCrudControllerDatas;
use models\Group;
use models\User;
use Ubiquity\controllers\crud\CRUDDatas;
use controllers\crud\viewers\IndexCrudControllerViewer;
use Ubiquity\controllers\crud\viewers\ModelViewer;
use controllers\crud\events\IndexCrudControllerEvents;
use Ubiquity\controllers\crud\CRUDEvents;
use controllers\crud\files\IndexCrudControllerFiles;
use Ubiquity\controllers\crud\CRUDFiles;
use Ubiquity\attributes\items\router\Route;

#[Route(path: "/crud/{resource}",inherited: true,automated: true)]
class IndexCrudController extends \Ubiquity\controllers\crud\MultiResourceCRUDController{

	#[Route(name: "crud.index",priority: -1)]
	public function index() {
		parent::index();
	}


	#[Route(path: "#//crud/home",name: "crud.home",priority: 100)]
	public function home(){
		parent::home();
	}

	protected function getIndexType():array {
		return ['two link cards','card'];
	}

    protected function getIndexModels(): array
    {
        return [Group::class, User::class];
    }

    protected function getIndexDefaultIcon(string $resource): string
    {
        return match ($resource) {
            'user' => 'blue user',
            'group' => 'red users',
            default => 'shower',
        };
    }


    public function _getBaseRoute():string {
		return "/crud/".$this->resource."";
	}
	
	protected function getAdminData(): CRUDDatas{
		return new IndexCrudControllerDatas($this);
	}

	protected function getModelViewer(): ModelViewer{
		return new IndexCrudControllerViewer($this,$this->style);
	}

	protected function getEvents(): CRUDEvents{
		return new IndexCrudControllerEvents($this);
	}

	protected function getFiles(): CRUDFiles{
		return new IndexCrudControllerFiles();
	}

}
