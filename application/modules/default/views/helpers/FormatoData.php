<?php

class Zend_View_Helper_FormatoData {

    function formatoData($data) {
      if (strripos($data, '-')) {
        $novaData = explode('-', $data);
        return $novaData[2].'/'.$novaData[1].'/'.$novaData[0];
      } else {
        return $data;
      }
    }
}