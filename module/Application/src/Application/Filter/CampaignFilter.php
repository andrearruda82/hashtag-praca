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