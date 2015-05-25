<?php

class Default_ClienteController extends Aplicacao_Controller_Action {

    public function indexAction() {
      $this->view->usuarioLogado = $this->usuarioLogado;
    }

    public function newAction() {
        /*$form = new Aplicacao_Form_Usuario();
        $this->view->form = $form;

        if($this->_request->isPost()) {
            if($form->isValid($this->data)) {
                $model = new Application_Model_Usuario();
                if($model->save($this->data))
                    $this->_redirect ('/admin/usuario');
            }
        }*/
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

    public function preDispatch() {
        $auth = Zend_Auth::getInstance();
        $auth->setStorage(new Zend_Auth_Storage_Session('admin'));
        if (!$auth->hasIdentity())
            $this->_redirect('/login');
    }
}