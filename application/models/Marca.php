<?php

class Application_Model_Marca extends Application_Model_Abstract {

    public function __construct() {
        $this->_dbTable = new Application_Model_DbTable_Marca();
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

    public function getMarcas() {
        $select = $this->_dbTable->select();
        return $this->_dbTable->fetchAll($select);
    }

    public function getSelectMarcas() {
        $marcas[''] = '-- Selecione a Marca --';
        foreach($this->_dbTable->fetchAll() as $marca) {
            $marcas[$marca['id']] = $marca['nome'];
        }
        return $marcas;
    }
}