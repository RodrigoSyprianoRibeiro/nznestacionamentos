<?php

class Application_Model_Estada extends Application_Model_Abstract {

    public function __construct() {
        $this->_dbTable = new Application_Model_DbTable_Estada();
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

    public function getMovimentacoesEstacionamento($id=null,$idCliente=null,$limit=null) {
        $select = $this->_dbTable->select();
        $select->setIntegrityCheck(false)
               ->from($this->_dbTable)
               ->join('veiculo',
                      'veiculo.id = estada.id_veiculo',
                      array('placa'))
               ->join('cliente',
                      'cliente.id = veiculo.id_cliente',
                      array('nome'))
               ->join('estacionamento',
                      'estacionamento.id = estada.id_estacionamento',
                      array('nome as estacionamento'));
       if ($id) {
          $select->where("estada.id_estacionamento = {$id}");
       }
       if ($idCliente) {
          $select->where("cliente.id = {$idCliente}");
       }
        $select->order(array('estada.entrada DESC','estada.saida DESC'));
      if ($limit) {
          $select->limit($limit);
       }
        return $this->_dbTable->fetchAll($select);
    }

    public function getDadosGraficoValoresMes() {

        $select = $this->_dbTable->select();
        $select->setIntegrityCheck(false)
               ->from($this->_dbTable,
                      array('estacionamento.nome','EXTRACT(MONTH FROM estada.entrada) AS mes','SUM(estada.valor) AS valor'))
               ->join('estacionamento',
                      'estacionamento.id = estada.id_estacionamento')
               ->group(array('estacionamento.nome','EXTRACT(MONTH FROM estada.entrada)'))
               ->order(array('estacionamento.nome','EXTRACT(MONTH FROM estada.entrada)'));
//echo "<pre>";
//print_r($select->__toString());
//die();
        $dados = $this->_dbTable->fetchAll($select);
        $meses = Aplicacao_Plugins_Util::getMeses();

        $nome = '';
        $dadosGerais = "";
        $dadosGrafico = "";
        $cores = Aplicacao_Plugins_Util::getCores();
        $i = -1;
        foreach($dados as $indice => $dado) {

        if ($nome != $dado['nome']) {
            $nome = $dado['nome'];
            $i++;

            if ($indice > 1)
              $dadosGrafico .= "]},";

            $dadosGerais .= $dadosGrafico;
            $dadosGrafico = '{label: "'.$dado['nome'].'", color: "'.$cores[$i].'", data: [';
        }
            $dadosGrafico .= '["'.$meses[$dado['mes']].'",'.$dado['valor'].'],';
        }
        $dadosGerais .= $dadosGrafico ."]}";
        return str_replace(",]}", "]}", $dadosGerais);
    }

    public function getDadosGraficoValoresMensal() {

        $select = $this->_dbTable->select();
        $select->setIntegrityCheck(false)
               ->from($this->_dbTable,
                      array('EXTRACT(MONTH FROM estada.entrada) AS mes','EXTRACT(YEAR FROM estada.entrada) AS ano', 'SUM(estada.valor) AS valor'))
               ->group(array('EXTRACT(MONTH FROM estada.entrada)','EXTRACT(YEAR FROM estada.entrada)'))
               ->order(array('EXTRACT(YEAR FROM estada.entrada)', 'EXTRACT(MONTH FROM estada.entrada)'));

        $dados = $this->_dbTable->fetchAll($select);
        $meses = Aplicacao_Plugins_Util::getMeses();

        $dadosGrafico = "";
        foreach($dados as $dado) {
          $dadosGrafico .= '["'.$meses[$dado['mes']].' / '.$dado['ano'].'",'.$dado['valor'].'],';
        }

        return $dadosGrafico;
    }

    public function getDadosGraficoValoresAnual() {

        $select = $this->_dbTable->select();
        $select->setIntegrityCheck(false)
               ->from($this->_dbTable,
                      array('EXTRACT(YEAR FROM estada.entrada) AS ano','SUM(estada.valor) AS valor'))
               ->group(array('EXTRACT(YEAR FROM estada.entrada)'))
               ->order(array('EXTRACT(YEAR FROM estada.entrada)'));

        $dados = $this->_dbTable->fetchAll($select);

        $dadosGrafico = "";
        foreach($dados as $dado) {
          $dadosGrafico .= '["'.$dado['ano'].'",'.$dado['valor'].'],';
        }

        return $dadosGrafico;
    }

    public function getEstacionamentoUso($id) {

        $select = $this->_dbTable->select();
        $select->setIntegrityCheck(false)
               ->from($this->_dbTable,
                      array('estacionamento.nome as estacionamento','COUNT(*) as quant'))
               ->join('estacionamento',
                      'estacionamento.id = estada.id_estacionamento')
               ->join('veiculo',
                      'veiculo.id = estada.id_veiculo')
               ->join('cliente',
                      'cliente.id = veiculo.id_cliente')
               ->where("cliente.id = {$id}")
               ->group('estacionamento.nome')
               ->order('estacionamento.nome');

        $dados = $this->_dbTable->fetchAll($select);
        $estacionamentos = array();
        $cores = Aplicacao_Plugins_Util::getCores();
        foreach($dados as $indice => $dado) {
          $estacionamentos[] = array("nome" => $dado['estacionamento'], "cor" => $cores[$indice]);
        }
        return $estacionamentos;
    }

    public function getUsoEstacionamento($id) {

        $select = $this->_dbTable->select();
        $select->setIntegrityCheck(false)
               ->from($this->_dbTable,
                      array('estacionamento.nome as estacionamento','COUNT(*) as quant'))
               ->join('estacionamento',
                      'estacionamento.id = estada.id_estacionamento')
               ->join('veiculo',
                      'veiculo.id = estada.id_veiculo')
               ->join('cliente',
                      'cliente.id = veiculo.id_cliente')
               ->where("cliente.id = {$id}")
               ->group('estacionamento.nome')
               ->order('estacionamento.nome');

        $dados = $this->_dbTable->fetchAll($select);
        $dadosGrafico = "";
        $cores = Aplicacao_Plugins_Util::getCores();
        foreach($dados as $indice => $dado) {
          $dadosGrafico .= '{value: '.$dado['quant'].', color: "'.$cores[$indice].'", highlight: "'.$cores[$indice].'", estacionamento: "'.$dado['estacionamento'].'"},';
        }
        return $dadosGrafico;
    }

    public function getDadosGraficoValoresEstacionamento() {

        $select = $this->_dbTable->select();
        $select->setIntegrityCheck(false)
               ->from($this->_dbTable,
                      array('SUM(estada.valor) as valor'))
               ->join('estacionamento',
                      'estacionamento.id = estada.id_estacionamento')
               ->group('estacionamento.nome')
               ->order('estacionamento.nome');

        $dados = $this->_dbTable->fetchAll($select);
        $dadosGrafico = '';
        $cores = Aplicacao_Plugins_Util::getCores();
        foreach($dados as $indice => $dado) {
            $dadosGrafico .= '{label: "'.$dado['nome'].'", data: '.$dado['valor'].', color: "'.$cores[$indice].'"},';
        }
        return $dadosGrafico;
    }
}