<?php

class Default_RelatorioController extends Aplicacao_Controller_Action {

    public function receitaAction() {
        /*$model = new Application_Model_Usuario();
        $pagina = intval($this->_getParam('pagina', 1));

        $params = array('pagina' => $pagina);

        $this->view->usuarios = $model->fetchAll($params);*/
    }

    public function movimentacaoestacionamentoAction() {
        /*$model = new Application_Model_Usuario();
        $pagina = intval($this->_getParam('pagina', 1));

        $params = array('pagina' => $pagina);

        $this->view->usuarios = $model->fetchAll($params);*/
    }

    public function movimentacaoclienteadministradorAction() {
        /*$model = new Application_Model_Usuario();
        $pagina = intval($this->_getParam('pagina', 1));

        $params = array('pagina' => $pagina);

        $this->view->usuarios = $model->fetchAll($params);*/
    }

    public function movimentacaoclienteAction() {
        /*$model = new Application_Model_Usuario();
        $pagina = intval($this->_getParam('pagina', 1));

        $params = array('pagina' => $pagina);

        $this->view->usuarios = $model->fetchAll($params);*/
    }

    /*
    public function preDispatch() {
        $auth = Zend_Auth::getInstance();
        $auth->setStorage(new Zend_Auth_Storage_Session('admin'));
        if (!$auth->hasIdentity())
            $this->_redirect('/admin/login');
    }*/
}