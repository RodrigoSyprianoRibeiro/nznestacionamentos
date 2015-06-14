<?php

class Default_ClienteController extends Aplicacao_Controller_Action {

    public function indexAction() {
        $modelCliente = new Application_Model_Cliente();
        $this->view->clientes = $modelCliente->getClientes();
    }

    public function newAction() {
        $formPessoa = new Aplicacao_Form_Pessoa();
        $this->view->form = $formPessoa;

        if($this->_request->isPost()) {
            if($formPessoa->isValid($this->data)) {
                $model = new Application_Model_Pessoa();
                if($model->save($this->data))
                    $this->_redirect ('/cliente');
            }
        }
    }

    public function editAction() {
        /*$model = new Application_Model_Usuario();
        $form = new Aplicacao_Form_Usuario();
        $id = (int) $this->_request->getParam("id",0);
        $usuario = $model->find($id);
        if($usuario) {
            $form->populate ($usuario->toArray());
            $form->getElement('id_perfil')->setValue($usuario->id_perfil);
        }
        $this->view->form = $form;

        if ($this->_request->isPost()) {
            if($id)
                $this->data['id'] = $id;
            if ($form->isValid($this->data)) {
                if ($model->save($this->data))
                    $this->_redirect ('/admin/usuario');
            }
        }*/
    }

    public function deleteAction() {
        /*$model = new Application_Model_Usuario();
        $form = new Aplicacao_Form_Usuario();
        $id = (int) $this->_request->getParam("id",0);
        if($id)
            $this->data['id'] = $id;
        if($model->delete($this->data))
            $this->_redirect ('/admin/usuario');

        $this->view->form = $form;
        $this->view->error = "Erro ao excluir Usuario";*/
    }

    public function comprarcreditoAction() {
        /*$model = new Application_Model_Usuario();
        $form = new Aplicacao_Form_Usuario();
        $id = (int) $this->_request->getParam("id",0);
        if($id)
            $this->data['id'] = $id;
        if($model->delete($this->data))
            $this->_redirect ('/admin/usuario');

        $this->view->form = $form;
        $this->view->error = "Erro ao excluir Usuario";*/
    }

    public function colocarcreditoAction() {
      $modelCliente = new Application_Model_Cliente();
      $this->view->clientes = $modelCliente->getClientes(true);
    }

    public function confirmarcompracreditoAction() {
      $this->_helper->layout->disableLayout();
      $this->_helper->viewRenderer->setNoRender(true);

      $data = array('id' => $this->_request->getParam("id",0),
                    'saldo' => $this->_request->getParam("valor",0)
              );

      $modelCliente = new Application_Model_Cliente();
      $modelCliente->_update($data);
    }

    public function alterastatusAction() {
      $this->_helper->layout->disableLayout();
      $this->_helper->viewRenderer->setNoRender(true);

      $modelCliente = new Application_Model_Cliente();
      $modelUsuario = new Application_Model_Usuario();

      $id = $this->_request->getParam("id",0);
      $status = $this->_request->getParam("status",0);
      $data = array('id' => $id,
                    'ativo' => $status,
              );
      $modelCliente->_update($data);

      $cliente = $modelCliente->find($id);
      $modelUsuario->alterastatusAction($status, $cliente->id_usuario);
    }

    public function preDispatch() {
        $auth = Zend_Auth::getInstance();
        $auth->setStorage(new Zend_Auth_Storage_Session('admin'));
        if (!$auth->hasIdentity())
            $this->_redirect('/login');
    }
}