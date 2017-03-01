<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'campaign' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/campaign',
                    'defaults' => [
                        'controller' => 'Application\Controller\Campaign',
                        'action' => 'index',
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'default' => [
                        'type' => 'Zend\Mvc\Router\Http\Segment',
                        'options' => [
                            'route' => '[[/:id]/:action][/page/:page][/order_by/:order_by][/:order]',
                            'constraints' => [
                                'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'     => '[0-9]+',
                                'page' => '[0-9]+',
                                'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'order' => 'asc|desc',
                            ],
                            'defaults' => [
                                'controller' => 'Application\Controller\Campaign',
                                'action' => 'index',
                            ]
                        ]
                    ]
                ]
            ],
            'hashtag' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/hashtag',
                    'defaults' => [
                        'controller' => 'Application\Controller\Hashtag',
                        'action' => 'index',
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'default' => [
                        'type' => 'Zend\Mvc\Router\Http\Segment',
                        'options' => [
                            'route' => '[[/:id]/:action][/page/:page][/order_by/:order_by][/:order]',
                            'constraints' => [
                                'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'     => '[0-9]+',
                                'page' => '[0-9]+',
                                'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'order' => 'asc|desc',
                            ],
                            'defaults' => [
                                'controller' => 'Application\Controller\Hashtag',
                                'action' => 'index',
                            ]
                        ]
                    ]
                ]
            ],
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => Controller\IndexController::class,
        ),
        'factories' => array(
            'Application\Controller\Campaign' => Factory\Controller\CampaignControllerFactory::class,
            'Application\Controller\Hashtag' => Factory\Controller\HashtagControllerFactory::class
        )
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'layout/blank'            => __DIR__ . '/../view/layout/blank.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
            'zfc-user' => __DIR__ . '/../view',
        ),
    ),

    'module_layouts' => array(
        'ZfcUser' => 'layout/blank'
    ),

    'doctrine' => [
        'eventmanager' => [
            'orm_default' => [
                'subscribers' => [
                    'Gedmo\Timestampable\TimestampableListener',
                    'Gedmo\SoftDeleteable\SoftDeleteableListener'
                ],
            ],
        ],
        'driver' => [
            __NAMESPACE__ . '_entity' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity']
            ],
            __NAMESPACE__ . '_repository' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/' . __NAMESPACE__ . '/Repository']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_entity',
                    __NAMESPACE__ . '\Repository' => __NAMESPACE__ . '_repository'
                ]
            ],
        ]
    ],

    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
