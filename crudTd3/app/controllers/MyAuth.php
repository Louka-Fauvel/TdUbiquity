<?php
namespace controllers;
use models\User;
use Ubiquity\orm\DAO;
use Ubiquity\utils\http\UResponse;
use Ubiquity\utils\http\USession;
use Ubiquity\utils\http\URequest;
use controllers\auth\files\MyAuthFiles;
use Ubiquity\controllers\auth\AuthFiles;
use Ubiquity\attributes\items\router\Route;

#[Route(path: "/login",inherited: true,automated: true)]
class MyAuth extends \Ubiquity\controllers\auth\AuthController{

	protected function onConnect($connected) {

		$urlParts=$this->getOriginalURL();
		USession::set($this->_getUserSessionKey(), $connected);
        //var_dump($connected);
        //var_dump($urlParts);
		if(isset($urlParts)) {

			$this->_forward(implode("/",$urlParts));

		} else {

            UResponse::header('location','/');

		}
	}

	protected function _connect() {

		if(URequest::isPost()) {

			$email=URequest::post($this->_getLoginInputName());
			$password=URequest::post($this->_getPasswordInputName());
            //var_dump($email);
            //$test=DAO::uGetOne(User::class, "email=? and password= ?",false,[$email,$password]);

            return DAO::uGetOne(User::class, "email=? and password= ?",false,[$email,$password]);

		}

		return;

	}
	
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\auth\AuthController::isValidUser()
	 */
	public function _isValidUser($action=null) {

		return USession::exists($this->_getUserSessionKey());

	}

	public function _getBaseRoute() {

		return '/login';

	}
	
	protected function getFiles(): AuthFiles {

		return new MyAuthFiles();

	}

    public function _displayInfoAsString() {

        return true;

    }

    protected function finalizeAuth() {

        if(!URequest::isAjax()) {

            $this->loadView('@activeTheme/main/vFooter.html');

        }
    }

    protected function initializeAuth() {

        if(!URequest::isAjax()) {

            $this->loadView('@activeTheme/main/vHeader.html');

        }
    }

    public function _getBodySelector() {

        return '#page-container';

    }

}
