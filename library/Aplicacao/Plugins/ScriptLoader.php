<?php

class Aplicacao_Plugins_ScriptLoader extends Zend_Controller_Plugin_Abstract {

    public static function loadJavascript($view, $scripts) {
        foreach ($scripts as $javascript) {
            $view->inlineScript()->appendFile($javascript);
        }
    }

    public static function loadCss($view, $scripts) {
        foreach ($scripts as $css) {
            $view->headLink()->appendStylesheet($css);
        }
    }
}