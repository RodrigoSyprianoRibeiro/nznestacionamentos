<?php

class Aplicacao_Plugins_Acl extends Zend_Controller_Plugin_Abstract {

    public function preDispatch(Zend_Controller_Request_Abstract $request) {

        $acl = new Zend_Acl();

        $acl->addRole(new Zend_Acl_Role('cliente'));
        $acl->addRole(new Zend_Acl_Role('funcionario'), 'cliente');
        $acl->addRole(new Zend_Acl_Role('master'), 'funcionario');

        $acl->add(new Zend_Acl_Resource('default:cliente'));
        $acl->add(new Zend_Acl_Resource('default:error'));
        $acl->add(new Zend_Acl_Resource('default:estacionamento'));
        $acl->add(new Zend_Acl_Resource('default:funcionario'));
        $acl->add(new Zend_Acl_Resource('default:index'));
        $acl->add(new Zend_Acl_Resource('default:login'));
        $acl->add(new Zend_Acl_Resource('default:relatorio'));
        $acl->add(new Zend_Acl_Resource('default:usuario'));
        $acl->add(new Zend_Acl_Resource('default:veiculo'));

        $acl->allow('cliente', 'default:cliente');
        $acl->allow('cliente', 'default:error');
        $acl->allow('cliente', 'default:estacionamento');
        $acl->allow('cliente', 'default:funcionario');
        $acl->allow('cliente', 'default:index');
        $acl->allow('cliente', 'default:login');
        $acl->allow('cliente', 'default:relatorio');
        $acl->allow('cliente', 'default:usuario');
        $acl->allow('cliente', 'default:veiculo');

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
                        ->setControllerName('login')
                        ->setActionName($identity->perfil);
            }
        }
    }
}