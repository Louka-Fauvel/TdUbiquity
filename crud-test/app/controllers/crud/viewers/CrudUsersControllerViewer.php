<?php
namespace controllers\crud\viewers;

use Ajax\semantic\html\collections\form\HtmlFormInput;
use models\User;
use Ubiquity\controllers\crud\viewers\ModelViewer;
 /**
  * Class CrudUsersControllerViewer
  */
class CrudUsersControllerViewer extends ModelViewer{

    public function getCaptions($captions, $className)
    {
        return ['Prénom', 'Nom', 'Organisation', 'Email'];
    }

    protected function getDataTableRowButtons()
    {
        return ['edit', 'display', 'delete', 'shower'];
    }

    public function getModelDataTable($instances, $model, $totalCount, $page = 1)
    {
        $dt = parent::getModelDataTable($instances, $model, $totalCount, $page);
        $dt->fieldAsLabel('email', 'mail');
        $dt->setValueFunction('lastname', function ($value, User $instances) {

            return "<b>".strtoupper($value)."</b>";
        });

        return $dt;
    }

    public function getForm($identifier, $instance, $updateUrl = 'updateModel')
    {

        $form = parent::getForm($identifier, $instance, $updateUrl);
        $form->fieldAsHidden('id');
        $form->fieldAsInput('password',['inputType'=>'password', 'jsCallback'=> function(HtmlFormInput $input) {
            $input->addTogglePasswordAction(type:1);
        }]);
        return $form;

    }

}
