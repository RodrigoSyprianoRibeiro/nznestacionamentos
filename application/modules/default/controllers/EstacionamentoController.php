<?php

class Default_EstacionamentoController extends Aplicacao_Controller_Action {

    public function indexAction() {
        $modelEstacionamento = new Application_Model_Estacionamento();
        $this->view->estacionamentos = $modelEstacionamento->getEstacionamentos();
    }

    public function newAction() {
        $modelEstacionamento = new Application_Model_Estacionamento();
        $form = new Aplicacao_Form_Estacionamento();
        $this->view->form = $form;

        if ($this->_request->isPost()) {
            if ($form->isValid($this->data)) {
                $modelEstacionamento->_insert($this->data);
                $id = $modelEstacionamento->getIdByCnpj($this->data['cnpj']);
                $_SESSION['cadastro'] = 'sucesso';
                $this->_redirect('/estacionamento/edit/id/'.$id);
            } else {
                 $this->view->erro = 'Preencha os todos campos Obrigatórios!';
            }
            $form->populate($this->data);
        }
    }

    public function editAction() {
        $modelEstacionamento = new Application_Model_Estacionamento();
        $form = new Aplicacao_Form_Estacionamento();
        $id = (int) $this->_request->getParam("id",0);
        $estacionamento = $modelEstacionamento->search($id);
        if($estacionamento) {
            if (isset($_SESSION['cadastro'])) {
                $this->view->novo = 'Estacionamento cadastrado com Sucesso!';
                unset($_SESSION['cadastro']);
            }
            $modelTabelaPreco = new Application_Model_TabelaPreco();
            $this->view->estacionamento = $estacionamento;
            $this->view->tabelasPrecos = $modelTabelaPreco->getTabelas($id);
            $form->populate($estacionamento->toArray());
        } else {
            $this->_redirect('/estacionamento');
        }
        $this->view->form = $form;

        if ($this->_request->isPost()) {
            if($id)
                $this->data['id'] = $id;

            if ($form->isValid($this->data)) {
                $modelTabelaPreco->apagaTabelas($id);
                $modelTabelaPreco->cadastraTabelas($this->data);
                $modelEstacionamento->_update($this->data);
                $this->view->sucesso = 'Estacionamento alterado com Sucesso!';
            } else {
                 $this->view->erro = 'Preencha os todos campos Obrigatórios!';
            }
            $modelTabelaPreco = new Application_Model_TabelaPreco();
            $this->view->tabelasPrecos = $modelTabelaPreco->getTabelas($id);
        }
    }

    public function alterastatusAction() {
      $this->_helper->layout->disableLayout();
      $this->_helper->viewRenderer->setNoRender(true);

      $modelEstacionamento = new Application_Model_Estacionamento();
      $data = array('id' => $this->_request->getParam("id",0),
                    'ativo' => $this->_request->getParam("status",0),
              );
      $modelEstacionamento->alterarStatus($data);
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

    public function preDispatch() {
        $auth = Zend_Auth::getInstance();
        $auth->setStorage(new Zend_Auth_Storage_Session('admin'));
        if (!$auth->hasIdentity())
            $this->_redirect('/login');
    }
}