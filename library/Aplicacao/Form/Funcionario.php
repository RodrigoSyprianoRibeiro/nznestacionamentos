<?php

class Aplicacao_Form_Funcionario extends Zend_Form
{
    public function init() {
        $this->setName('funcionario');

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

        $matricula = new Zend_Form_Element_Text('matricula');
        $matricula->setRequired(true)
                  ->addFilter('StripTags')
                  ->addFilter('StringTrim')
                  ->addValidator('NotEmpty');
        $this->addElement($matricula);

        $dataAdmissao = new Zend_Form_Element_Text('data_admissao');
        $dataAdmissao->setRequired(true)
                     ->addFilter('StripTags')
                     ->addFilter('StringTrim')
                     ->addValidator('NotEmpty');
        $this->addElement($dataAdmissao);

        $salario = new Zend_Form_Element_Text('salario');
        $salario->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        $this->addElement($salario);

        $login = new Zend_Form_Element_Text('login');
        $login->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        $this->addElement($login);

        $model = new Application_Model_Estacionamento();
        $estacionamento = new Zend_Form_Element_Select('id_estacionamento');
        $estacionamento->setRequired(true)
                       ->addFilter('StripTags')
                       ->addFilter('StringTrim')
                       ->addValidator('NotEmpty')
                       ->setAttrib('class', 'form-control')
                       ->setAttrib('required', 'true')
                       ->addMultiOptions($model->getSelectEstacionamentos());
        $this->addElement($estacionamento);
    }

    public function isValid($data) {
        /*
        if(isset($data['email']) && !empty($data['email'])) {
            $emailValidator = new Zend_Validate_Db_NoRecordExists('funcionario', 'email');
            $this->getElement('email')
                 ->addValidator($emailValidator);
        }*/
        return parent::isValid($data);
    }
}