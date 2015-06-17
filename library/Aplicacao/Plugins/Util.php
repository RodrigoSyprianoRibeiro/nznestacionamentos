<?php

class Aplicacao_Plugins_Util extends Zend_Controller_Plugin_Abstract
{
    public static function getCores(){
        return array('#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#0073b7');
    }

    public static function getMeses(){
        return array('1' => 'Janeiro',
                     '2' => 'Fevereiro',
                     '3' => 'Março',
                     '4' => 'Abril',
                     '5' => 'Maio',
                     '6' => 'Junho',
                     '7' => 'Julho',
                     '8' => 'Agosto',
                     '9' => 'Setembro',
                     '10' => 'Outubro',
                     '11' => 'Novembro',
                     '12' => 'Dezembro');
    }
}