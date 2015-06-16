<?php

class Application_Model_Funcionario extends Application_Model_Abstract {

    public function __construct() {
        $this->_dbTable = new Application_Model_DbTable_Funcionario();
    }

    public function _insert(array $data) {
        unset($this->data['login']);
        $data['data_nascimento'] = Aplicacao_Plugins_Formato::data($data['data_nascimento']);
        $data['data_admissao'] = Aplicacao_Plugins_Formato::data($data['data_admissao']);
        $data['salario'] = Aplicacao_Plugins_Formato::dinheiro($data['salario']);
        return $this->_dbTable->insert($data);
    }

    public function _update(array $data) {
        unset($this->data['login']);
        $data['data_nascimento'] = Aplicacao_Plugins_Formato::data($data['data_nascimento']);
        $data['data_admissao'] = Aplicacao_Plugins_Formato::data($data['data_admissao']);
        $data['salario'] = Aplicacao_Plugins_Formato::dinheiro($data['salario']);
        return $this->_dbTable->update($data, array('id=?'=>$data['id']));
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