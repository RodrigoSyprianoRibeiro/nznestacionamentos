<?php

class Aplicacao_Form_Estacionamento extends Zend_Form
{
    public function init() {
        $this->setName('estacionamento');

        $nome = new Zend_Form_Element_Text('nome');
        $nome->setRequired(true)
             ->addFilter('StripTags')
             ->addFilter('StringTrim')
             ->addValidator('NotEmpty')
             ->setAttrib('class', 'form-control')
             ->setAttrib('placeholder', 'Nome');
        $this->addElement($nome);

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

        $logradouro = new Zend_Form_Element_Text('logradouro');
        $logradouro->setRequired(true)
                   ->addFilter('StripTags')
                   ->addFilter('StringTrim')
                   ->addValidator('NotEmpty');
        $this->addElement($logradouro);

        $numero = new Zend_Form_Element_Text('numero');
        $numero->addFilter('StripTags')
               ->addFilter('StringTrim');
        $this->addElement($numero);

        $complemento = new Zend_Form_Element_Text('complemento');
        $complemento->addFilter('StripTags')
                    ->addFilter('StringTrim');
        $this->addElement($complemento);

        $bairro = new Zend_Form_Element_Text('bairro');
        $bairro->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');
        $this->addElement($bairro);

        $cep = new Zend_Form_Element_Text('cep');
        $cep->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');
        $this->addElement($cep);

        $cidade = new Zend_Form_Element_Text('cidade');
        $cidade->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');
        $this->addElement($cidade);

        $uf = new Zend_Form_Element_Select('uf');
        $uf->setLabel('UF')
           ->setRequired(true)
           ->addFilter('StripTags')
           ->addFilter('StringTrim')
           ->addValidator('NotEmpty')
           ->setAttrib('class', 'form-control')
           ->addMultiOptions(array('' => '-- Selecione o Estado --',
                                   'PR' => 'PR',
                                   'RS' => 'RS',
                                   'SC' => 'SC',));
        $this->addElement($uf);

        $nrVagaComum = new Zend_Form_Element_Text('nr_vaga_comum');
        $nrVagaComum->setRequired(true)
                    ->addFilter('StripTags')
                    ->addFilter('StringTrim');
        $this->addElement($nrVagaComum);

        $nrVagaEspecial = new Zend_Form_Element_Text('nr_vaga_especial');
        $nrVagaEspecial->setRequired(true)
                       ->addFilter('StripTags')
                       ->addFilter('StringTrim');
        $this->addElement($nrVagaEspecial);

        $nrVagaAluguel = new Zend_Form_Element_Text('nr_vaga_aluguel');
        $nrVagaAluguel->setRequired(true)
                      ->addFilter('StripTags')
                      ->addFilter('StringTrim');
        $this->addElement($nrVagaAluguel);
    }

    public function isValid($data) {
        if(isset($data['cnpj']) && !empty($data['cnpj']) && !isset($data['id'])) {
            $cnpjValidator = new Zend_Validate_Db_NoRecordExists('estacionamento', 'cnpj');
            $this->getElement('cnpj')
                 ->addValidator($cnpjValidator);
        }
        return parent::isValid($data);
    }
}