<?php

class Application_Model_PessoaJuridica extends Application_Model_Abstract {

    public function __construct() {
        $this->_dbTable = new Application_Model_DbTable_PessoaJuridica();
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

    public function getPessoaJuridica($id) {
        $select = $this->_dbTable->select();
        $select->where("id = {$id}");
        return $this->_dbTable->fetchRow($select);
    }
}