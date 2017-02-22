<?php
return [
    'navigation' => [
        'default' => [
            'home' => [
                'label' => 'Home',
                'route' => 'home',
                'icon' => 'home',
            ],
            'campaign' => [
                'label' => 'Campanhas',
                'route' => 'campaign',
                'icon' => 'assignment',
                'pages' => [
                    'add' => [
                        'label' => 'Adicionar',
                        'route' => 'campaign/default',
                        'action' => 'add',
                    ],
                    'edit' => [
                        'label' => 'Editar',
                        'route' => 'campaign/default',
                        'action' => 'edit',
                    ]
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