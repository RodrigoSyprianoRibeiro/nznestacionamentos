<?php

class Zend_View_Helper_FormatoDinheiro {

    function formatoDinheiro($valor) {
        return str_replace(".", ",", $valor);
    }
}