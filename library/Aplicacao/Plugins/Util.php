<?php

class Aplicacao_Plugins_Util extends Zend_Controller_Plugin_Abstract
{
    public static function getCores(){
        return array('#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#0073b7');
    }

    public static function getMeses(){
        return array('1' => 'Jan',
                     '2' => 'Fev',
                     '3' => 'Mar',
                     '4' => 'Abr',
                     '5' => 'Mai',
                     '6' => 'Jun',
                     '7' => 'Jul',
                     '8' => 'Ago',
                     '9' => 'Set',
                     '10' => 'Out',
                     '11' => 'Nov',
                     '12' => 'Dez');
    }
}