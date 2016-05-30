<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Rsswire;

return [
    'controllers' => [
        'invokables' => [
            'rsswire-controller-index' => Controller\IndexController::class,
    
        ],
    ],
    'router' => [
        'routes' => [
            'rss' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route'    => '/rss',
                    'defaults' => [
                        'controller' => 'rsswire-controller-index',
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => array(
        'strategies'               => ['ViewFeedStrategy'],
        'display_not_found_reason' => false,
        'display_exceptions'       => false,
        'doctype'                  => 'HTML5',
    ),
];
