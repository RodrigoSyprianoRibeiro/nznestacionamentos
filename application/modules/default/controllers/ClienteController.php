<?php

class Default_ClienteController extends Aplicacao_Controller_Action {

    public function indexAction() {
        $modelCliente = new Application_Model_Cliente();
        $this->view->clientes = $modelCliente->getClientes();
    }

    public function newAction() {
        $modelCliente = new Application_Model_Cliente();
        $modelUsuario = new Application_Model_Usuario();
        $form = new Aplicacao_Form_Cliente();
        $this->view->form = $form;

        if ($this->_request->isPost()) {
            if (!$modelUsuario->existeLogin(0, $this->data['login'])) {
                if ($form->isValid($this->data)) {
                   $modelUsuario->_insert(array('login'=>$this->data['login'],
                                                'senha'=>'teste',
                                                'id_perfil'=>3));
                    $this->data['id_usuario'] = $modelUsuario->getId($this->data['login']);
                    $modelCliente->_insert($this->data);
                    if ($this->data['tipo'] == 'fisica') {
                        $id = $modelCliente->getIdByCpf($this->data['cpf']);
                    } else {
                        $id = $modelCliente->getIdByCnpj($this->data['cnpj']);
                    }
                    $_SESSION['cadastro'] = 'sucesso';
                    $this->_redirect('/cliente/edit/id/'.$id);
                } else {
                     $this->view->erro = 'Preencha os todos campos Obrigatórios!';
                }
            } else {
                $this->view->erro = 'Login já em uso!';
            }
            $form->populate($this->data);
        }
    }

    public function editAction() {
        $modelCliente = new Application_Model_Cliente();
        $modelUsuario = new Application_Model_Usuario();
        $form = new Aplicacao_Form_Cliente();
        $id = (int) $this->_request->getParam("id",0);
        $cliente = $modelCliente->search($id);
        if($cliente) {
            if (isset($_SESSION['cadastro'])) {
                $this->view->novo = 'Cliente cadastrado com Sucesso!';
                unset($_SESSION['cadastro']);
            }
            $this->view->cliente = $cliente;
            $form->populate($cliente->toArray());
            $form->getElement('login')->setValue($modelUsuario->getLogin($cliente->id_usuario));
        } else {
            $this->_redirect('/cliente');
        }
        $this->view->form = $form;

        if ($this->_request->isPost()) {
            if($id)
                $this->data['id'] = $id;

            if (!$modelUsuario->existeLogin($cliente->id_usuario, $this->data['login'])) {
                $modelUsuario->save(array('id'=>$cliente->id_usuario,'login'=>$this->data['login']));
                if ($form->isValid($this->data)) {
                    $modelCliente->_update($this->data);
                    $this->view->sucesso = 'Cliente alterado com Sucesso!';
                } else {
                     $this->view->erro = 'Preencha os todos campos Obrigatórios!';
                }
            } else {
                $this->view->erro = 'Login já em uso!';
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
      $dataCliente = array('id' => $id,
                           'ativo' => $status,
                     );
      $modelCliente->alterarStatus($dataCliente);

      $cliente = $modelCliente->find($id);
      $dataUsuario = array('id' => $cliente->id_usuario,
                           'ativo' => $status,
                     );
      $modelUsuario->alterarStatus($dataUsuario);
    }

    public function preDispatch() {
        $auth = Zend_Auth::getInstance();
        $auth->setStorage(new Zend_Auth_Storage_Session('admin'));
        if (!$auth->hasIdentity())
            $this->_redirect('/login');
    }
}