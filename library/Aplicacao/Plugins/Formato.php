<?php

class Aplicacao_Plugins_Formato extends Zend_Controller_Plugin_Abstract
{
    public static function data($data){
        $novaData = explode('/', $data);
        return $novaData[2]."-".$novaData[1]."-".$novaData[0];
    }

    public static function dinheiro($valor){
        return str_replace(',', '.', $valor);
    }
}