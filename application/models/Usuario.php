<?php

class Application_Model_Usuario extends Application_Model_Abstract {

    public function __construct() {
        $this->_dbTable = new Application_Model_DbTable_Usuario();
    }

    public function _insert(array $data) {
        $data['senha'] = md5($data['senha']);
        return $this->_dbTable->insert($data);
    }

    public function _update(array $data) {
        if (isset($data['senha']))
            $data['senha'] = md5($data['senha']);

        return $this->_dbTable->update($data, array('id=?'=>$data['id']));
    }

    public function _delete(array $data) {
        return $this->_dbTable->delete(array('id=?'=>$data['id']));
    }

    public function setAcessoAtual($id) {
        return $this->_dbTable->update(array('acesso_atual' => date('Y-m-d H:i:s')),
                                       array('id=?'=>$id));
    }

    public function setUltimoAcesso($data, $id) {
        return $this->_dbTable->update(array('ultimo_acesso' => $data),
                                       array('id=?'=>$id));
    }

    public function getId($login) {
        $select = $this->_dbTable->select();
        $select->where("login = '{$login}'");
        return $this->_dbTable->fetchRow($select)->id;
    }

    public function getLogin($id) {
        $select = $this->_dbTable->select();
        $select->where("id = {$id}");
        return $this->_dbTable->fetchRow($select)->login;
    }

    public function existeLogin($id, $login) {
        $select = $this->_dbTable->select();
        $select->where("id <> {$id} AND login = '{$login}'");
        return !empty($this->_dbTable->fetchRow($select)->login) ? true : false;
    }
}