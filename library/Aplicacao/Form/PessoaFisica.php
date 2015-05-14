<?php

class Aplicacao_Form_PessoaFisica extends Zend_Form
{
    public function init()
    {
        $this->setName('pessoaFisica');

        $cpf = new Zend_Form_Element_Text('cpf');
        $cpf->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty')
            ->setErrorMessages(array('Campo CPF Obrigatório'))
            ->setAttrib('class', 'form-control')
            ->setAttrib('placeholder', 'CPF')
            ->setAttrib('title', 'Informe o seu CPF');
        $this->addElement($cpf);

        $rg = new Zend_Form_Element_Text('rg');
        $rg->setRequired(true)
           ->addFilter('StripTags')
           ->addFilter('StringTrim')
           ->addValidator('NotEmpty')
           ->setErrorMessages(array('Campo RG Obrigatório'))
           ->setAttrib('class', 'form-control')
           ->setAttrib('placeholder', 'RG')
           ->setAttrib('title', 'Informe o seu RG');
        $this->addElement($rg);

        $dataNascimento = new Zend_Form_Element_Text('dataNascimento');
        $dataNascimento->setRequired(true)
                       ->addFilter('StripTags')
                       ->addFilter('StringTrim')
                       ->addValidator('NotEmpty')
                       ->setErrorMessages(array('Campo Data de Nascimento Obrigatório'))
                       ->setAttrib('class', 'form-control')
                       ->setAttrib('placeholder', 'Data de Nascimento')
                       ->setAttrib('title', 'Informe a Data de Nascimento');
        $this->addElement($dataNascimento);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Enviar')
                ->setAttrib('type', 'submit');
        $this->addElement($submit);
    }

    public function isValid($data)
    {
        if(isset($data['email']) && !empty($data['email']) && !isset($data['id'])) {
            $emailValidator = new Zend_Validate_Db_NoRecordExists('usuario', 'email');
            $this->getElement('email')
                 ->addValidator( $emailValidator );
        }
        return parent::isValid($data);
    }
}