<?php
namespace controllers;

use Ubiquity\attributes\items\acl\Allow;
use Ubiquity\attributes\items\acl\Permission;
use Ubiquity\attributes\items\acl\Resource;
use Ubiquity\attributes\items\router\Get;
use Ubiquity\attributes\items\router\Post;
use Ubiquity\attributes\items\router\Route;
use Ubiquity\controllers\auth\AuthController;
use Ubiquity\controllers\auth\WithAuthTrait;
use Ubiquity\security\acl\controllers\AclControllerTrait;
use Ubiquity\security\csrf\UCsrfHttp;
use Ubiquity\security\data\EncryptionManager;
use Ubiquity\utils\http\URequest;
use Ubiquity\utils\http\USession;

// install phpmv/ubiquity-security dans composer
#[Route(path: "Main",automated: true)]
#[Resource('Main')]
class MainController extends ControllerBase {

	use AclControllerTrait, WithAuthTrait {
        WithAuthTrait::isValid insteadof AclControllerTrait;
        AclControllerTrait::isValid as isValidAcl;
    }

    #[Permission('READ', 49)]
    #[Allow('@USER', 'Main', 'READ')]
	public function index() {
		$this->loadView("MainController/index.html");
	}

    #[Route('autre')]
    #[Permission('SHOW', 50)]
    public function autreAction() {

        echo "SHOW autorisé";
    }

	public function _getRole() {

        return USession::get('activeUser', '@NOBODY');
	}

	/**
	 * {@inheritdoc}
	 * @see \Ubiquity\controllers\Controller::onInvalidControl()
	 */
	public function onInvalidControl() {
		echo $this->_getRole() . ' is not allowed!';
	}

    protected function getAuthController(): AuthController
    {
        return new MyAuth($this);
    }

    #[Allow('@USER')]
    #[Get('debit/{id}')]
    public function debitCompte($id) {

        echo "Le compte $id a été débité";

    }

    #[Allow('@USER')]
    #[Post('debit', name: "main.debitPost")]
    public function debitComptePost() {

        if (!URequest::isCrossSite() && UCsrfHttp::isValidPost('debit.form')) {
            $numero = URequest::post('id');
            echo "Le compte $numero a été débité<br>";
            $crypt = EncryptionManager::encrypt($numero);
            echo "version cryptée : <pre>$crypt</pre><br>";
            USession::set('num', $crypt);

            $decrypt = EncryptionManager::decryptString($crypt);
            echo "version décryptée : <pre>$decrypt</pre><br>";

        } else {

            echo "<h1>Tentative d'attaque CSRF !</h1>";

        }

    }

    #[Route('load')]
    #[Allow('@USER')]
    public function  loadNumCompte() {

        $crypt = USession::get('num');
        echo "version cryptée : <pre>$crypt</pre><br>";

        $decrypt = EncryptionManager::decryptString($crypt);
        echo "version décryptée : <pre>$decrypt</pre><br>";

    }

    #[Allow('@USER')]
	#[Get(path: "debitForm",name: "main.debitForm")]
	public function debitForm(){
		
		$this->loadView('MainController/debitForm.html');

	}

}
