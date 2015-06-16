<?php

class Application_Model_Estacionamento extends Application_Model_Abstract {

    public function __construct() {
        $this->_dbTable = new Application_Model_DbTable_Estacionamento();
    }

    public function _insert(array $data) {
        unset($data['descricao']);
        unset($data['tempo']);
        unset($data['valor']);
        $data['data_fundacao'] = Aplicacao_Plugins_Formato::data($data['data_fundacao']);
        return $this->_dbTable->insert($data);
    }

    public function _update(array $data) {
        unset($data['descricao']);
        unset($data['tempo']);
        unset($data['valor']);
        $data['data_fundacao'] = Aplicacao_Plugins_Formato::data($data['data_fundacao']);
        return $this->_dbTable->update($data, array('id=?'=>$data['id']));
    }

    public function _delete(array $data) {
        return $this->_dbTable->delete(array('id=?'=>$data['id']));
    }

    public function getIdByCnpj($cnpj) {
        $select = $this->_dbTable->select();
        $select->where("cnpj = '{$cnpj}'");
        return $this->_dbTable->fetchRow($select)->id;
    }

    public function getEstacionamentos($ativos=null) {
        $select = $this->_dbTable->select();
        if ($ativos) {
          $select->where("ativo = '1'");
        }
        return $this->_dbTable->fetchAll($select);
    }

    public function getNome($id) {
        $select = $this->_dbTable->select();
        $select->where("id = {$id}");
        return $this->_dbTable->fetchRow($select)->nome;
    }

    public function getSelectEstacionamentos() {
        $estacionamentos[''] = '-- Selecione o Estacionamento --';
        foreach($this->_dbTable->fetchAll() as $estacionamento) {
            $estacionamentos[$estacionamento['id']] = $estacionamento['nome'];
        }
        return $estacionamentos;
    }
}