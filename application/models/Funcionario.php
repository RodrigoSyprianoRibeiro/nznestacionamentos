<?php

class Application_Model_Funcionario extends Application_Model_Abstract {

    public function __construct() {
        $this->_dbTable = new Application_Model_DbTable_Funcionario();
    }

    public function _insert(array $data) {
        unset($data['login']);
        $data['data_nascimento'] = Aplicacao_Plugins_Formato::data($data['data_nascimento']);
        $data['data_admissao'] = Aplicacao_Plugins_Formato::data($data['data_admissao']);
        $data['salario'] = Aplicacao_Plugins_Formato::dinheiro($data['salario']);
        return $this->_dbTable->insert($data);
    }

    public function _update(array $data) {
        unset($data['login']);
        $data['data_nascimento'] = Aplicacao_Plugins_Formato::data($data['data_nascimento']);
        $data['data_admissao'] = Aplicacao_Plugins_Formato::data($data['data_admissao']);
        $data['salario'] = Aplicacao_Plugins_Formato::dinheiro($data['salario']);
        return $this->_dbTable->update($data, array('id=?'=>$data['id']));
    }

    public function getGraficoQuantFuncionarios() {

        $select = $this->_dbTable->select();
        $select->setIntegrityCheck(false)
               ->from($this->_dbTable,
                      array('COUNT(funcionario.id) as quant'))
               ->join('estacionamento',
                      'estacionamento.id = funcionario.id_estacionamento')
               ->group(array('estacionamento.id','estacionamento.nome'))
               ->order('estacionamento.nome');

        $dados = $this->_dbTable->fetchAll($select);

        $dadosGrafico = '';
        $cores = Aplicacao_Plugins_Util::getCores();
        foreach($dados as $indice => $dado) {
            $dadosGrafico .= '{label: "'.$dado['nome'].'", data: '.$dado['quant'].', color: "'.$cores[$indice].'"},';
        }
        return $dadosGrafico;
    }

    public function getDadosGraficoSalariosEstacionamentos() {

        $select = $this->_dbTable->select();
        $select->setIntegrityCheck(false)
               ->from($this->_dbTable,
                      array('SUM(funcionario.salario) as soma'))
               ->join('estacionamento',
                      'estacionamento.id = funcionario.id_estacionamento')
               ->group(array('estacionamento.id','estacionamento.nome'))
               ->order('estacionamento.nome');

        $dados = $this->_dbTable->fetchAll($select);

        $dadosGrafico = '';
        $cores = Aplicacao_Plugins_Util::getCores();
        foreach($dados as $indice => $dado) {
            $dadosGrafico .= '{label: "'.$dado['nome'].'", data: '.$dado['soma'].', color: "'.$cores[$indice].'"},';
        }
        return $dadosGrafico;
    }

    public function _delete(array $data) {
        return $this->_dbTable->delete(array('id=?'=>$data['id']));
    }

    public function getIdByCpf($cpf) {
        $select = $this->_dbTable->select();
        $select->where("cpf = '{$cpf}'");
        return $this->_dbTable->fetchRow($select)->id;
    }

    public function getFuncionarios() {
        $select = $this->_dbTable->select();
        return $this->_dbTable->fetchAll($select);
    }
}