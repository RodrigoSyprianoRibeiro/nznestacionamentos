<?php

abstract class Aplicacao_Controller_Action extends Zend_Controller_Action {

    protected $userId;
    protected $userLogin;
    protected $userPerfil;
    protected $data;

    public function init() {
        $this->flashMessenger = $this->_helper->FlashMessenger;
        $this->view->messages = $this->flashMessenger->getMessages();

        if ($this->_request->isPost()) {
            $this->data = $this->_request->getPost();
            if (isset($this->data['submit']))
                unset($this->data['submit']);
        }
        $auth = Zend_Auth::getInstance();
        $auth->setStorage(new Zend_Auth_Storage_Session('admin'));
        if ($auth->hasIdentity()) {
            $this->userId = $auth->getIdentity()->id;
            $this->userLogin = $auth->getIdentity()->login;
            $this->userPerfil = $auth->getIdentity()->perfil;
        }
    }
}