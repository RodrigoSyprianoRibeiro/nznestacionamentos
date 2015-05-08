<?php
    class Aplicacao_Form_Login extends Zend_Form
    {
        public function init()
        {
            $this->setName('login');
            $this->setAttrib('class', 'login');

            $login = new Zend_Form_Element_Text('login');
            $login->setRequired(true)
                  ->addFilter('StripTags')
                  ->addFilter('StringTrim')
                  ->addValidator('NotEmpty')
                  ->setErrorMessages(array('Campo Login Obrigatório'))
                  ->setAttrib('class', 'form-control')
                  ->setAttrib('placeholder', 'Login')
                  ->setAttrib('title', 'Informe o login');
            $this->addElement($login);

            $password = new Zend_Form_Element_Password('senha');
            $password->setRequired(true)
                     ->addFilter('StripTags')
                     ->addFilter('StringTrim')
                     ->addValidator('NotEmpty')
                     ->setErrorMessages(array('Campo Senha Obrigatório'))
                     ->setAttrib('class', 'form-control')
                     ->setAttrib('placeholder', 'Senha')
                     ->setAttrib('title', 'Informe a senha');
            $this->addElement($password);

            $submit = new Zend_Form_Element_Submit('submit');
            $submit->setLabel('Entrar')
                   ->setAttrib('class', 'btn btn-danger btn-block btn-flat')
                   ->setAttrib('type', 'submit');
            $this->addElement($submit);
        }
    }