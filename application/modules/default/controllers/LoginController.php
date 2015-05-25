<?php

class Default_LoginController extends Aplicacao_Controller_Action {

    public function indexAction() {

        if (!Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('admin'))->hasIdentity()) {

            $layout = Zend_Layout::getMvcInstance();
            $layout->setLayout("login");

            $form = new Aplicacao_Form_Login();
            $this->view->form = $form;

            if ($this->_request->isPost()) {
                if ($form->isValid($this->data)) {
                    $authAdapter = $this->getAuthAdapter();
                    $authAdapter->setIdentity($this->data['login'])
                                ->setCredential($this->data['senha']);

                    $select = $authAdapter->getDbSelect();
                    $select->join(array('p' => 'perfil'), 'p.id = usuario.id_perfil', array('perfil' => 'nome'));

                    $result = $authAdapter->authenticate();

                    if ($result->isValid()) {
                        $auth = Zend_Auth::getInstance();
                        $auth->setStorage(new Zend_Auth_Storage_Session('admin'));
                        $dataAuth = $authAdapter->getResultRowObject(null, 'senha');
                        $dataAuth->acessoAtual = date('Y-m-d H:i:s');
                        $auth->getStorage()->write($dataAuth);

                        $model = new Application_Model_Usuario();
                        $model->setAcessoAtual($dataAuth->id);

                        $this->_redirect("/index/".$dataAuth->perfil);
                    } else {
                        $this->view->error = "Usuário ou senha inválidos";
                        $form->populate($this->data);
                    }
                }
            }
        } else {
            $this->_redirect('/');
        }
    }

    public function signupAction() {
        $layout = Zend_Layout::getMvcInstance();
        $layout->setLayout("login");
    }

    private function getAuthAdapter() {
        $bootstrap = $this->getInvokeArg('bootstrap');
        $resource = $bootstrap->getPluginResource('db');
        $db = $resource->getDbAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($db);
        $authAdapter->setTableName('usuario')
                     ->setIdentityColumn('login')
                     ->setCredentialColumn('senha')
                     ->setCredentialTreatment('MD5(?)');

        return $authAdapter;
    }

    public function logoutAction() {
        $auth = Zend_Auth::getInstance();
        $auth->setStorage(new Zend_Auth_Storage_Session('admin'));
        $model = new Application_Model_Usuario();
        $model->setUltimoAcesso($auth->getIdentity()->acessoAtual, $auth->getIdentity()->id);
        $auth->clearIdentity();
        $this->_redirect('/login');
    }
}