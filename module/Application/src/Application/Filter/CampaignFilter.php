<?php

namespace Application\Filter;

use Zend\InputFilter\InputFilter;

class CampaignFilter extends InputFilter
{
    public function __construct()
    {
        $this->add([
            'name' => 'name',
            'required' => true,
            'filters' => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim']
            ],
            'validators' => [
                [
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                ],
                [
                    'name' => 'StringLength',
                    'break_chain_on_failure' => true,
                    'options' => [
                        'max' => 45
                    ]
                ],
            ]
        ]);

        $this->add([
            'name' => 'period_start',
            'required' => true,
            'filters' => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim']
            ],
            'validators' => [
                [
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                ],
                [
                    'name' => 'StringLength',
                    'break_chain_on_failure' => true,
                    'options' => [
                        'max' => 10
                    ]
                ],
                [
                    'name' => 'Date',
                    'break_chain_on_failure' => true,
                    'options' => [
                        'format' => 'd/m/Y',
                    ]
                ],
                [
                    'name' => 'Callback',
                    'break_chain_on_failure' => true,
                    'options' => [
                        'messages' => [
                            \Zend\Validator\Callback::INVALID_VALUE => 'Periodo inválido, data início maior que a data final.'
                        ],
                        'callback' => function($value, $context = []) {

                            $period_start = \DateTime::createFromFormat('d/m/Y', $value);
                            $period_final = \DateTime::createFromFormat('d/m/Y', $context['period_final']);

                            return $period_start > $period_final ? false : true;
                        }
                    ]
                ]
            ]
        ]);

        $this->add([
            'name' => 'period_final',
            'required' => true,
            'filters' => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim']
            ],
            'validators' => [
                [
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                ],
                [
                    'name' => 'StringLength',
                    'break_chain_on_failure' => true,
                    'options' => [
                        'max' => 10
                    ]
                ],
                [
                    'name' => 'Date',
                    'break_chain_on_failure' => true,
                    'options' => [
                        'format' => 'd/m/Y',
                    ]
                ]
            ]
        ]);
    }
}