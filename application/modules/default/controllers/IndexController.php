<?php

class Default_IndexController extends Aplicacao_Controller_Action {

    public function indexAction() {
      //$this->_redirect('/index/'.$this->usuarioLogado->perfil);
      $layout = Zend_Layout::getMvcInstance();
      $layout->disableLayout();
    }

    public function masterAction() {
        //$usuario = Zend_Auth::getInstance()->getIdentity();
        //$this->view->usuario = $usuario;

        //$model = new Application_Model_Usuario();
        //$this->view->quantidadeUsuarios = $model->count();
    }


    public function funcionarioAction() {
        //$usuario = Zend_Auth::getInstance()->getIdentity();
        //$this->view->usuario = $usuario;

        //$model = new Application_Model_Usuario();
        //$this->view->quantidadeUsuarios = $model->count();
    }

    public function clienteAction() {
        //$usuario = Zend_Auth::getInstance()->getIdentity();
        //$this->view->usuario = $usuario;

        //$model = new Application_Model_Usuario();
        //$this->view->quantidadeUsuarios = $model->count();
    }

    public function preDispatch() {
        $auth = Zend_Auth::getInstance();
        $auth->setStorage(new Zend_Auth_Storage_Session('admin'));
        if (!$auth->hasIdentity())
            $this->_redirect('/login');
    }
}