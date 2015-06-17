<?php

class Zend_View_Helper_FormatoData {

    function formatoData($data, $hora='') {

      if (!empty($hora)) {
        $dados = explode(" ", $data);
        $data = $dados[0];
        $hora = ' '.$dados[1];
      }

      if (strripos($data, '-')) {
        $novaData = explode('-', $data);
        return $novaData[2].'/'.$novaData[1].'/'.$novaData[0].$hora;
      } else {
        return $data.$hora;
      }
    }
}