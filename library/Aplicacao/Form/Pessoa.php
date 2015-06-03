<?php

class Aplicacao_Form_Pessoa extends Zend_Form
{
    public function init()
    {
        $this->setName('pessoa');

        $nome = new Zend_Form_Element_Text('nome');
        $nome->setRequired(true)
             ->addFilter('StripTags')
             ->addFilter('StringTrim')
             ->addValidator('NotEmpty')
             ->setErrorMessages(array('Campo Nome Obrigatório'))
             ->setAttrib('class', 'form-control')
             ->setAttrib('placeholder', 'Nome')
             ->setAttrib('title', 'Informe o Nome');
        $this->addElement($nome);

        $email = new Zend_Form_Element_Text('email');
        $email->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
              ->addValidator('EmailAddress')
              ->setErrorMessages(array('Campo E-mail Obrigatório'))
              ->setAttrib('class', 'form-control')
              ->setAttrib('placeholder', 'E-mail')
              ->setAttrib('title', 'Informe o E-mail');
        $this->addElement($email);

        $telefone = new Zend_Form_Element_Text('telefone');
        $telefone->setRequired(true)
                 ->addFilter('StripTags')
                 ->addFilter('StringTrim')
                 ->addValidator('NotEmpty')
                 ->setErrorMessages(array('Campo Telefone Obrigatório'))
                 ->setAttrib('class', 'form-control')
                 ->setAttrib('placeholder', 'Telefone')
                 ->setAttrib('title', 'Informe o Telefone');
        $this->addElement($telefone);
    }

    public function isValid($data)
    {
        if(isset($data['email']) && !empty($data['email']) && !isset($data['id'])) {
            $emailValidator = new Zend_Validate_Db_NoRecordExists('pessoa', 'email');
            $this->getElement('email')
                 ->addValidator($emailValidator);
        }
        return parent::isValid($data);
    }
}