<?php

class Zend_View_Helper_FormatoData {

    function formatoData($data) {
        $data = new DateTime($data);
        return $data->format('d/m/Y');
    }
}