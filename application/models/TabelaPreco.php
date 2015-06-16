<?php

class Application_Model_TabelaPreco extends Application_Model_Abstract {

    public function __construct() {
        $this->_dbTable = new Application_Model_DbTable_TabelaPreco();
    }

    public function _insert(array $data) {
        return $this->_dbTable->insert($data);
    }

    public function _update(array $data) {
        return $this->_dbTable->update($data, array('id=?'=>$data['id']));
    }

    public function _delete(array $data) {
        return $this->_dbTable->delete(array('id=?'=>$data['id']));
    }

    public function getTabelas($idEstacionamento) {
        $select = $this->_dbTable->select();
        $select->where("id_estacionamento = {$idEstacionamento}");
        return $this->_dbTable->fetchAll($select);
    }

    public function apagaTabelas($idEstacionamento) {
        return $this->_dbTable->delete(array('id_estacionamento=?'=>$idEstacionamento));
    }

    public function cadastraTabelas($data) {
        foreach ($data['descricao'] as $indice => $descricao) {
          $this->_dbTable->insert(
                    array('descricao'=>$descricao,
                          'tempo'=>(int)$data['tempo'][$indice],
                          'valor'=>Aplicacao_Plugins_Formato::dinheiro($data['valor'][$indice]),
                          'id_estacionamento'=>$data['id'],
                        ));
        }
    }
}