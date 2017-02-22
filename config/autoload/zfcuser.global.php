<?php
return [
    'zfcuser' => [
        'enable_username' => false,
        'enable_registration' => false,
        'enable_user_state' => true,
        'default_user_state' => 1,
        'allowed_login_states' => [1],
        'login_redirect_route' => 'home',
        'logout_redirect_route' => 'zfcuser/login',
        'enable_default_entities' => false,
        'user_entity_class' => Application\Entity\User::class,
    ]
];
