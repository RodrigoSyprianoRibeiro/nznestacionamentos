<?php

class Default_EstacionamentoController extends Aplicacao_Controller_Action {

    public function indexAction() {
        $modelEstacionamento = new Application_Model_Estacionamento();
        $this->view->estacionamentos = $modelEstacionamento->getEstacionamentos();
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
        $modelEstacionamento = new Application_Model_Estacionamento();
        $form = new Aplicacao_Form_Estacionamento();

        $id = (int) $this->_request->getParam("id",0);
        $estacionamento = $modelEstacionamento->find($id);

        if($estacionamento)
            $form->populate($estacionamento->toArray());

        $this->view->form = $form;

        if ($this->_request->isPost()) {
            if($id)
                $this->data['id'] = $id;
            if ($form->isValid($this->data)) {
                if ($modelEstacionamento->save($this->data))
                    $this->_redirect ('/admin/usuario');
            }
        }
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

    public function consultarvagasAction() {
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

    public function consultarCidadeAction($uf) {
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

    public function alterastatusAction() {
      $this->_helper->layout->disableLayout();
      $this->_helper->viewRenderer->setNoRender(true);

      $modelEstacionamento = new Application_Model_Estacionamento();
      $data = array('id' => $this->_request->getParam("id",0),
                    'ativo' => $this->_request->getParam("status",0),
              );
      $modelEstacionamento->_update($data);
    }

    public function preDispatch() {
        $auth = Zend_Auth::getInstance();
        $auth->setStorage(new Zend_Auth_Storage_Session('admin'));
        if (!$auth->hasIdentity())
            $this->_redirect('/login');
    }
}