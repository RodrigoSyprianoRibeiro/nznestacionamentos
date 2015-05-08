<?php

class Aplicacao_Plugins_Acl extends Zend_Controller_Plugin_Abstract {

    public function preDispatch(Zend_Controller_Request_Abstract $request) {

        $acl = new Zend_Acl();

        $acl->addRole(new Zend_Acl_Role('usuario'));
        $acl->addRole(new Zend_Acl_Role('admin'), 'usuario');

        $acl->add(new Zend_Acl_Resource('default:login', 'logout'));
        $acl->add(new Zend_Acl_Resource('default:index'));
        $acl->add(new Zend_Acl_Resource('default:usuario'));
        $acl->add(new Zend_Acl_Resource('default:error'));

        $acl->allow('usuario', 'default:login', 'logout');
        $acl->allow('usuario', 'default:index');
        $acl->allow('usuario', 'default:error', array('error', 'forbidden'));
        $acl->deny('usuario', 'default:usuario');
        $acl->allow('admin', 'default:usuario');

        // Primeiro vamos instânciar o Zend_Auth
        $auth = Zend_Auth::getInstance();
        $auth->setStorage(new Zend_Auth_Storage_Session('admin'));
        // Agora vamos descobri qual o modulo, controller e action que o usuário está acessando
        $module = $request->getModuleName();
        $controller = $request->getControllerName();
        $action = $request->getActionName();

        if($auth->hasIdentity()) {
            $identity = $auth->getIdentity();

            if(!$acl->has($module . ':' . $controller, $action) or
                    !$acl->isAllowed($identity->perfil, 'default:'.$controller, $action)) {
                $request->setModuleName('default')
                        ->setControllerName('index')
                        ->setActionName('index');
            }
        }
    }
}