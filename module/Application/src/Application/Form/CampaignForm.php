<?php

namespace Application\Form;

use Zend\Form\Form;

class CampaignForm extends Form
{
    public function __construct()
    {
        parent::__construct(null);

        parent::__construct(null);

        $this->setAttribute('class', 'form');

        $this->add([
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf'
        ]);

        $this->add([
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
            'attributes' => [
                'id' => 'id',
            ]
        ]);

        $this->add([
            'type' => 'Zend\Form\Element\Text',
            'name' => 'name',
            'options' => [
                'label' => 'Nome',
                'label_attributes' => [
                    'class'  => 'form-label'
                ]
            ],
            'attributes' => [
                'id' => 'name',
                'required' => true,
                'class' => 'form-control',
                'maxlength' => 45
            ],
        ]);

        $this->add([
            'type' => 'Zend\Form\Element\Text',
            'name' => 'period_start',
            'options' => [
                'label' => 'Data início',
                'label_attributes' => [
                    'class'  => 'form-label'
                ]
            ],
            'attributes' => [
                'id' => 'period_start',
                'required' => true,
                'class' => 'form-control date',
                'maxlength' => 10
            ],
        ]);

        $this->add([
            'type' => 'Zend\Form\Element\Text',
            'name' => 'period_final',
            'options' => [
                'label' => 'Data final',
                'label_attributes' => [
                    'class' => 'form-label'
                ]
            ],
            'attributes' => [
                'id' => 'period_final',
                'required' => true,
                'class' => 'form-control date',
                'maxlength' => 10
            ],
        ]);
    }
}