<?php

class Default_IndexController extends Aplicacao_Controller_Action {

    public function masterAction() {
      $modelEstacionamento = new Application_Model_Estacionamento();
      $this->view->quantidadeEstacionamento= $modelEstacionamento->count();

      $modelFuncionario = new Application_Model_Funcionario();
      $this->view->quantidadeFuncionario = $modelFuncionario->count();

      $this->view->dadosGraficoSalarios = $modelFuncionario->getDadosGraficoSalariosEstacionamentos();
      $this->view->dadosGraficoQuantFuncionarios = $modelFuncionario->getGraficoQuantFuncionarios();
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