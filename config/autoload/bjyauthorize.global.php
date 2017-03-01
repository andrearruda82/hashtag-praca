<?php
return [
    'bjyauthorize' => [
        'unauthorized_strategy' => \BjyAuthorize\View\RedirectionStrategy::class,
        'identity_provider' => \BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider::class,
        'role_providers' => [
            \BjyAuthorize\Provider\Role\ObjectRepositoryProvider::class => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'role_entity_class' => Application\Entity\UserRole::class,
            ],
        ],
        'resource_providers' => [
            \BjyAuthorize\Provider\Resource\Config::class => [
            ],
        ],
        'rule_providers' => [
            \BjyAuthorize\Provider\Rule\Config::class => [
                'allow' => [
                ]
            ],
        ],
        'guards' => [
            \BjyAuthorize\Guard\Route::class => [
                ['route' => 'zfcuser', 'roles' => ['user']],
                ['route' => 'zfcuser/logout', 'roles' => ['user']],
                ['route' => 'zfcuser/login', 'roles' => ['guest']],
                ['route' => 'zfcuser/register', 'roles' => ['guest']],

                ['route' => 'home', 'roles' => ['user']],

                ['route' => 'campaign', 'roles' => ['user']],
                ['route' => 'campaign/default', 'roles' => ['user']],

                ['route' => 'hashtag', 'roles' => ['user']],
                ['route' => 'hashtag/default', 'roles' => ['user']],
            ]
        ]
    ],
];
