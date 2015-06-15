<?php

class Application_Model_Cliente extends Application_Model_Abstract {

    public function __construct() {
        $this->_dbTable = new Application_Model_DbTable_Cliente();
    }

    public function _insert(array $data) {
        if ($data['tipo'] == 'fisica') {
            $data['data_nascimento'] = Aplicacao_Plugins_Formato::data($data['data_nascimento']);
            unset($data['cnpj']);
            unset($data['data_fundacao']);
        } else {
            $data['data_fundacao'] = Aplicacao_Plugins_Formato::data($data['data_fundacao']);
            unset($data['cpf']);
            unset($data['rg']);
            unset($data['data_nascimento']);
        }
        return $this->_dbTable->insert($data);
    }

    public function _update(array $data) {
        if ($data['tipo'] == 'fisica') {
            $data['data_nascimento'] = Aplicacao_Plugins_Formato::data($data['data_nascimento']);
            unset($data['cnpj']);
            unset($data['data_fundacao']);
        } else {
            $data['data_fundacao'] = Aplicacao_Plugins_Formato::data($data['data_fundacao']);
            unset($data['cpf']);
            unset($data['rg']);
            unset($data['data_nascimento']);
        }
        return $this->_dbTable->update($data, array('id=?'=>$data['id']));
    }

    public function _delete(array $data) {
        return $this->_dbTable->delete(array('id=?'=>$data['id']));
    }

    public function alterarStatus(array $data) {
        return $this->_dbTable->update($data, array('id=?'=>$data['id']));
    }

    public function getIdByCpf($cpf) {
        $select = $this->_dbTable->select();
        $select->where("cpf = '{$cpf}'");
        return $this->_dbTable->fetchRow($select)->id;
    }

    public function getIdByCnpj($cnpj) {
        $select = $this->_dbTable->select();
        $select->where("cnpj = '{$cnpj}'");
        return $this->_dbTable->fetchRow($select)->id;
    }

    public function getClientes($ativos=null) {
        $select = $this->_dbTable->select();
        if ($ativos) {
          $select->where("ativo = '1'");
        }
        return $this->_dbTable->fetchAll($select);
    }
}