<?php

namespace Flickr;


use Laminas\Mvc\Controller\LazyControllerAbstractFactory;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Flickr\Controller\IndexController;
use Flickr\Model\Flickr;

return [
    'router' => [
        'routes' => [
            'flickr' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/flickr',
                    'defaults' => [
                        'controller' => \Flickr\Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'default' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '[/:action[/:id]]',
                            'defaults' => [
                                'controller' => IndexController::class,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            Flickr::class => InvokableFactory::class,
        ]
    ],
    'controllers' => [
        'factories' => [
			IndexController::class => LazyControllerAbstractFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
