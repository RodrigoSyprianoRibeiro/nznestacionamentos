<?php

class Application_Model_Cliente extends Application_Model_Abstract {

    public function __construct() {
        $this->_dbTable = new Application_Model_DbTable_Cliente();
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

    public function getClientes($ativos=null) {
        $select = $this->_dbTable->select();
        if ($ativos) {
          $select->where("ativo = '1'");
        }
        return $this->_dbTable->fetchAll($select);
    }
}