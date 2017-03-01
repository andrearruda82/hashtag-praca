<?php

namespace Application\Form;

use Zend\Form\Form;
use Doctrine\ORM\EntityManager;

class HashtagForm extends Form
{
    public function __construct(EntityManager $entityManager)
    {
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
            'name' => 'tag',
            'options' => [
                'label' => 'Tag',
                'label_attributes' => [
                    'class'  => 'form-label'
                ]
            ],
            'attributes' => [
                'id' => 'tag',
                'required' => true,
                'class' => 'form-control',
                'maxlength' => 45
            ],
        ]);

        $this->add([
            'name' => 'campaign',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => [
                'object_manager' => $entityManager,
                'target_class' => 'Application\Entity\Campaign',
                'property' => 'name',
                'display_empty_item' => true,
                'empty_item_label' => 'Escolha um campanha',
                'find_method' => [
                    'name' => 'findBy',
                    'params' => [
                        'criteria' => [],
                        'orderBy' => ['name' => 'ASC'],
                    ]
                ],
                'label' => 'Campanha',
                'label_attributes' => [
                    'class'  => 'form-label'
                ]
            ],
            'attributes' => [
                'id' => 'campaign',
                'class' => 'form-control'
            ],
        ]);
    }
}