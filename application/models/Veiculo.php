<?php

class Application_Model_Veiculo extends Application_Model_Abstract {

    public function __construct() {
        $this->_dbTable = new Application_Model_DbTable_Veiculo();
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

    public function getVeiculos($ativos=null) {
        $select = $this->_dbTable->select();
        if ($ativos) {
          $select->where("ativo = '1'");
        }
        return $this->_dbTable->fetchAll($select);
    }

    public function getVeiculosCliente($id) {

        $select = $this->_dbTable->select();
        $select->setIntegrityCheck(false)
               ->from($this->_dbTable)
               ->join('marca',
                      'marca.id = veiculo.id_marca',
                       array('marca.nome as marca'))
               ->join('modelo',
                      'modelo.id = veiculo.id_modelo',
                       array('modelo.nome as modelo'))
               ->where("id_cliente = {$id} AND ativo = '1'")
               ->order(array('marca.nome','modelo.nome'));

        return $this->_dbTable->fetchAll($select);
    }

    public function getSelectCores() {
        $cores[''] = '-- Selecione a Cor --';
        $cores['bg-red-active'] = 'Vermelho';
        $cores['bg-yellow-active'] = 'Amarelo';
        $cores['bg-green-active'] = 'Verde';
        $cores['bg-black-active'] = 'Preto';
        $cores['bg-blue-active'] = 'Azul';
        return $cores;
    }
}