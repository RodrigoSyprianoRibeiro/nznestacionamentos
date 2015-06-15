<?php

class Default_FuncionarioController extends Aplicacao_Controller_Action {

    public function indexAction() {
        $modelFuncionario = new Application_Model_Funcionario();
        $this->view->funcionarios = $modelFuncionario->getFuncionarios();
    }

    public function newAction() {
        $modelFuncionario = new Application_Model_Funcionario();
        $modelUsuario = new Application_Model_Usuario();
        $form = new Aplicacao_Form_Funcionario();
        $this->view->form = $form;

        if ($this->_request->isPost()) {
            if (!$modelUsuario->existeLogin(0, $this->data['login'])) {
                if ($form->isValid($this->data)) {
                    $modelUsuario->_insert(array('login'=>$this->data['login'],
                                                 'senha'=>'teste',
                                                 'id_perfil'=>2));
                    $this->data['id_usuario'] = $modelUsuario->getId($this->data['login']);
                    unset($this->data['login']);
                    $modelFuncionario->_insert($this->data);
                    $id = $modelFuncionario->getIdByCpf($this->data['cpf']);
                    $_SESSION['cadastro'] = 'sucesso';
                    $this->_redirect('/funcionario/edit/id/'.$id);
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
        $modelFuncionario = new Application_Model_Funcionario();
        $modelUsuario = new Application_Model_Usuario();
        $form = new Aplicacao_Form_Funcionario();
        $id = (int) $this->_request->getParam("id",0);
        $funcionario = $modelFuncionario->search($id);
        if($funcionario) {
            if (isset($_SESSION['cadastro'])) {
                $this->view->novo = 'Funcionário cadastrado com Sucesso!';
                unset($_SESSION['cadastro']);
            }
            $this->view->funcionario = $funcionario;
            $form->populate($funcionario->toArray());
            $form->getElement('login')->setValue($modelUsuario->getLogin($funcionario->id_usuario));
            $form->getElement('id_estacionamento')->setValue($funcionario->id_estacionamento);
        } else {
            $this->_redirect('/funcionario');
        }
        $this->view->form = $form;

        if ($this->_request->isPost()) {
            if($id)
                $this->data['id'] = $id;

            if (!$modelUsuario->existeLogin($funcionario->id_usuario, $this->data['login'])) {
                $modelUsuario->save(array('id'=>$funcionario->id_usuario,'login'=>$this->data['login']));
                if ($form->isValid($this->data)) {
                    unset($this->data['login']);
                    $modelFuncionario->_update($this->data);
                    $this->view->sucesso = 'Funcionário alterado com Sucesso!';
                } else {
                     $this->view->erro = 'Preencha os todos campos Obrigatórios!';
                }
            } else {
                $this->view->erro = 'Login já em uso!';
            }
        }
    }

    public function alterastatusAction() {
      $this->_helper->layout->disableLayout();
      $this->_helper->viewRenderer->setNoRender(true);

      $modelFuncionario = new Application_Model_Funcionario();
      $modelUsuario = new Application_Model_Usuario();

      $id = $this->_request->getParam("id",0);
      $status = $this->_request->getParam("status",0);
      $data = array('id' => $id,
                    'ativo' => $status,
              );
      $modelFuncionario->alterarStatus($data);

      $fucionario = $modelFuncionario->find($id);
      $modelUsuario->alterastatusAction($status, $fucionario->id_usuario);
    }

    public function preDispatch() {
        $auth = Zend_Auth::getInstance();
        $auth->setStorage(new Zend_Auth_Storage_Session('admin'));
        if (!$auth->hasIdentity())
            $this->_redirect('/login');
    }
}