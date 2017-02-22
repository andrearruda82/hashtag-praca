<?php

$config = array(
    'modules' => array(
//        'ZendDeveloperTools',
        'Zf2Whoops',
        'DoctrineModule', 'DoctrineORMModule',
        'ZfcBase', 'ZfcUser', 'ZfcUserDoctrineORM',
        'EdpModuleLayouts',
        'Application',
    ),

    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor',
        ),

        'config_glob_paths' => array(
            'config/autoload/{{,*.}global,{,*.}local}.php',
        ),
    ),
);

if (! \Zend\Console\Console::isConsole()) {
    array_push($config['modules'], 'BjyAuthorize');
}

return $config;
