<?php

class Aplicacao_Form_Veiculo extends Zend_Form
{
    public function init() {
        $this->setName('veiculo');

        $modelMarca = new Application_Model_Marca();
        $marca = new Zend_Form_Element_Select('id_marca');
        $marca->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
              ->setAttrib('class', 'form-control')
              ->setAttrib('required', 'true')
              ->addMultiOptions($modelMarca->getSelectMarcas());
        $this->addElement($marca);

        $modelModelo = new Application_Model_Modelo();
        $modelo = new Zend_Form_Element_Select('id_modelo');
        $modelo->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty')
               ->setAttrib('class', 'form-control')
               ->setAttrib('required', 'true')
               ->addMultiOptions($modelModelo->getSelectModelos());
        $this->addElement($modelo);

        $modelVeiculo = new Application_Model_Veiculo();
        $cor = new Zend_Form_Element_Select('cor');
        $cor->setRequired(true)
                       ->addFilter('StripTags')
                       ->addFilter('StringTrim')
                       ->addValidator('NotEmpty')
                       ->setAttrib('class', 'form-control')
                       ->setAttrib('required', 'true')
                       ->addMultiOptions($modelVeiculo->getSelectCores());
        $this->addElement($cor);

        $placa = new Zend_Form_Element_Text('placa');
        $placa->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        $this->addElement($placa);
    }

    public function isValid($data) {
        return parent::isValid($data);
    }
}