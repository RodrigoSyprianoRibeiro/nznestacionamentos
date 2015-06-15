<?php

class Aplicacao_Form_Cliente extends Zend_Form
{
    public function init() {
        $this->setName('cliente');

        $nome = new Zend_Form_Element_Text('nome');
        $nome->setRequired(true)
             ->addFilter('StripTags')
             ->addFilter('StringTrim')
             ->addValidator('NotEmpty');
        $this->addElement($nome);

        $email = new Zend_Form_Element_Text('email');
        $email->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
              ->addValidator('EmailAddress');
        $this->addElement($email);

        $telefone = new Zend_Form_Element_Text('telefone');
        $telefone->setRequired(true)
                 ->addFilter('StripTags')
                 ->addFilter('StringTrim')
                 ->addValidator('NotEmpty');
        $this->addElement($telefone);

        $cpf = new Zend_Form_Element_Text('cpf');
        $cpf->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');
        $this->addElement($cpf);

        $rg = new Zend_Form_Element_Text('rg');
        $rg->setRequired(true)
           ->addFilter('StripTags')
           ->addFilter('StringTrim')
           ->addValidator('NotEmpty');
        $this->addElement($rg);

        $dataNascimento = new Zend_Form_Element_Text('data_nascimento');
        $dataNascimento->setRequired(true)
                       ->addFilter('StripTags')
                       ->addFilter('StringTrim')
                       ->addValidator('NotEmpty');
        $this->addElement($dataNascimento);

        $cnpj = new Zend_Form_Element_Text('cnpj');
        $cnpj->setRequired(true)
             ->addFilter('StripTags')
             ->addFilter('StringTrim')
             ->addValidator('NotEmpty');
        $this->addElement($cnpj);

        $dataFundacao = new Zend_Form_Element_Text('data_fundacao');
        $dataFundacao->setRequired(true)
                     ->addFilter('StripTags')
                     ->addFilter('StringTrim')
                     ->addValidator('NotEmpty');
        $this->addElement($dataFundacao);

        $login = new Zend_Form_Element_Text('login');
        $login->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        $this->addElement($login);
    }

    public function isValid($data) {
        if ($data['tipo'] == 'fisica') {
            $this->getElement('cpf')->setRequired(true);
            $this->getElement('rg')->setRequired(true);
            $this->getElement('data_nascimento')->setRequired(true);
            $this->getElement('cnpj')->setRequired(false);
            $this->getElement('data_fundacao')->setRequired(false);
        } else {
            $this->getElement('cnpj')->setRequired(true);
            $this->getElement('data_fundacao')->setRequired(true);
            $this->getElement('cpf')->setRequired(false);
            $this->getElement('rg')->setRequired(false);
            $this->getElement('data_nascimento')->setRequired(false);
        }
        return parent::isValid($data);
    }
}