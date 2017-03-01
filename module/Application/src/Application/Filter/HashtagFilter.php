<?php

namespace Application\Filter;

use Zend\InputFilter\InputFilter;

class HashtagFilter extends InputFilter
{
    public function __construct()
    {
        $this->add([
            'name' => 'tag',
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
            'name' => 'run_time_script',
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
                    'name' => 'Between',
                    'break_chain_on_failure' => true,
                    'options' => [
                        'min' => 5,
                        'max' => 60,
                    ]
                ],
            ]
        ]);
    }
}