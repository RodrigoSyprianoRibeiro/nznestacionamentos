<?php

class Default_IndexController extends Aplicacao_Controller_Action {

    public function masterAction() {
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
    }


    public function funcionarioAction() {
        $modelFuncionario = new Application_Model_Funcionario();
        $funcionario = $modelFuncionario->getFuncionarioByIdUsuario($this->usuarioLogado->id);

        $modelEstacionamento = new Application_Model_Estacionamento();
        $estacionamento = $modelEstacionamento->search($funcionario['id_estacionamento']);

        $modelEstada = new Application_Model_Estada();
        $this->view->movimentacoes = $modelEstada->getMovimentacoesEstacionamento($estacionamento['id']);

        $this->view->funcionario = $funcionario;
        $this->view->estacionamento = $estacionamento;
    }

    public function clienteAction() {
        $modelCliente = new Application_Model_Cliente();
        $cliente = $modelCliente->getClienteByIdUsuario($this->usuarioLogado->id);

        $modelEstada = new Application_Model_Estada();
        $this->view->movimentacoes = $modelEstada->getMovimentacoesEstacionamento(null,$cliente['id'],10);

        $this->view->estacionamentoUsados = $modelEstada->getEstacionamentoUso($cliente['id']);
        $this->view->usoEstacionamento = $modelEstada->getUsoEstacionamento($cliente['id']);

        $modelVeiculo = new Application_Model_Veiculo();
        $this->view->veiculos = $modelVeiculo->getVeiculosCliente($cliente['id']);

        $this->view->cliente = $cliente;
    }

    public function preDispatch() {
        $auth = Zend_Auth::getInstance();
        $auth->setStorage(new Zend_Auth_Storage_Session('admin'));
        if (!$auth->hasIdentity())
            $this->_redirect('/login');
    }
}