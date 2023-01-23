<?php

namespace Maps;

use Maps\Controller\IndexController;
use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;

use Laminas\Mvc\Controller\LazyControllerAbstractFactory;
use Laminas\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;
use Maps\Controller\IndexControllerFactory;
use Maps\Form\GeopointForm;
use Maps\Model\Geopoint;

return [
    'router' => [
        'routes' => [
            'maps' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/maps',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            // 'maps' => [
            //     'type' => Literal::class,
            //     'options' => [
            //         'route' => '/maps',
            //         'defaults' => [
            //             'controller' => IndexController::class,
            //             'action' => 'pobierz',
            //         ],
            //     ],
            // ],
            'mapsDodajAdres' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/maps/dodaj',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action'     => 'dodaj',
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
            'factories' => [
                Geopoint::class => InvokableFactory::class,
                GeopointForm::class => ReflectionBasedAbstractFactory::class,
            ],
    ],
    'controllers' => [
        'factories' => [
            IndexController::class => IndexControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
