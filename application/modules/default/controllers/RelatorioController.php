<?php

class Default_RelatorioController extends Aplicacao_Controller_Action {

    public function receitaAction() {
      $modelEstacionamento = new Application_Model_Estacionamento();
      $this->view->quantidadeEstacionamento= $modelEstacionamento->count(true);

      $modelFuncionario = new Application_Model_Funcionario();
      $this->view->quantidadeFuncionario = $modelFuncionario->count(true);

      $modelCliente = new Application_Model_Cliente();
      $this->view->quantidadeCliente = $modelCliente->count(true);

      $modelEstada = new Application_Model_Estada();

      $this->view->dadosGraficoSalarios = $modelFuncionario->getDadosGraficoSalariosEstacionamentos();
      $this->view->dadosGraficoQuantFuncionarios = $modelFuncionario->getGraficoQuantFuncionarios();
      $this->view->dadosGraficoValoresMes = $modelEstada->getDadosGraficoValoresMes();
      $this->view->dadosGraficoValoresEstacionamento = $modelEstada->getDadosGraficoValoresEstacionamento();

      $this->view->dadosGraficoValoresMesal = $modelEstada->getDadosGraficoValoresMensal();
      $this->view->dadosGraficoValoresAnual = $modelEstada->getDadosGraficoValoresAnual();
    }

    public function movimentacaoestacionamentoAction() {
        $modelEstacionamento = new Application_Model_Estacionamento();
        $modelEstada = new Application_Model_Estada();

        if ($this->usuarioLogado->perfil == 'funcionario') {
          $modelFuncionario = new Application_Model_Funcionario();
          $funcionario = $modelFuncionario->getFuncionarioByIdUsuario($this->usuarioLogado->id);
          $estacionamento = $modelEstacionamento->search($funcionario['id_estacionamento']);
          $this->view->movimentacoes = $modelEstada->getMovimentacoesEstacionamento($estacionamento['id']);
          $this->view->funcionario = $funcionario;
        } else {
          $estacionamento = $modelEstacionamento->getEstacionamentos();
          $this->view->movimentacoes = $modelEstada->getMovimentacoesEstacionamento();
        }

        $this->view->estacionamento = $estacionamento;
    }

    public function movimentacaoclienteadministradorAction() {

        $idCliente = (int) $this->_request->getParam("id",0);
        if (!empty($idCliente)) {

            $modelCliente = new Application_Model_Cliente();
            $cliente = $modelCliente->search($idCliente);

            if(!$cliente)
                $this->_redirect('/cliente');
        } else {
            $idCliente = null;
        }
        $modelEstacionamento = new Application_Model_Estacionamento();
        $modelEstada = new Application_Model_Estada();

        if ($this->usuarioLogado->perfil == 'funcionario') {
          $modelFuncionario = new Application_Model_Funcionario();
          $funcionario = $modelFuncionario->getFuncionarioByIdUsuario($this->usuarioLogado->id);
          $estacionamento = $modelEstacionamento->search($funcionario['id_estacionamento']);
          $this->view->movimentacoes = $modelEstada->getMovimentacoesEstacionamento($estacionamento['id'],$idCliente);
          $this->view->funcionario = $funcionario;
        } else {
          $estacionamento = $modelEstacionamento->getEstacionamentos();
          $this->view->movimentacoes = $modelEstada->getMovimentacoesEstacionamento(null,$idCliente);
        }

        $this->view->estacionamento = $estacionamento;
    }

    public function movimentacaoclienteAction() {
        $idCliente = (int) $this->_request->getParam("id",0);
        $modelCliente = new Application_Model_Cliente();
        $cliente = $modelCliente->search($idCliente);

        if(!$cliente)
            $this->_redirect('/cliente');

        $modelEstada = new Application_Model_Estada();
        $this->view->movimentacoes = $modelEstada->getMovimentacoesEstacionamento(null,$idCliente);
    }

    public function preDispatch() {
        $auth = Zend_Auth::getInstance();
        $auth->setStorage(new Zend_Auth_Storage_Session('admin'));
        if (!$auth->hasIdentity())
            $this->_redirect('/login');
    }
}