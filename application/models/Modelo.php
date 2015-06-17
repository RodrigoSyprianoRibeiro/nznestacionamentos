<?php

class Application_Model_Modelo extends Application_Model_Abstract {

    public function __construct() {
        $this->_dbTable = new Application_Model_DbTable_Modelo();
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

    public function getModelos() {
        $select = $this->_dbTable->select();
        return $this->_dbTable->fetchAll($select);
    }

    public function getSelectModelos($idMarca=null) {

        $select = $this->_dbTable->select();
        if ($idMarca) {
          $select->where("id_marca = {$idMarca}");
        }

        $modelos[''] = '-- Selecione o Modelo --';
        foreach($this->_dbTable->fetchAll($select) as $modelo) {
            $modelos[$modelo['id']] = $modelo['nome'];
        }
        return $modelos;
    }
}