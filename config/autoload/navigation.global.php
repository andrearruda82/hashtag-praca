<?php
return [
    'navigation' => [
        'default' => [
            'home' => [
                'label' => 'Home',
                'route' => 'home',
                'action' => 'index',
                'icon' => 'home'
            ],
            'registration' => [
                'label' => 'Cadastros',
                'uri' => 'javascript:void(0);',
                'icon' => 'assignment',
                'pages' => [
                    'campaign' => [
                        'label' => 'Campanhas',
                        'route' => 'campaign',
                        'action' => 'index',
                        'pages' => [
                            'add' => [
                                'label' => 'Adicionar',
                                'route' => 'campaign/default',
                                'action' => 'add',
                            ],
                            'edit' => [
                                'label' => 'Editar',
                                'route' => 'campaign/default',
                                'action' => 'edit'
                            ]
                        ]
                    ],
                ]
            ],
        ]
    ],
    'service_manager' => [
        'factories' => [
            'navigation' => \Zend\Navigation\Service\DefaultNavigationFactory::class
        ],
    ],
];