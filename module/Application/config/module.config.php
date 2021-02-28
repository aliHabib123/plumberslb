<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

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
        	'about' => array(
        			'type' => 'Zend\Mvc\Router\Http\Literal',
       				'options' => array(
       						'route'    => '/about',
       						'defaults' => array(
       								'controller' => 'Application\Controller\Index',
       								'action'     => 'about',
       						),
       				),
       		),
       		'search' => array(
       				'type' => 'Zend\Mvc\Router\Http\Literal',
       				'options' => array(
       						'route'    => '/search',
       						'defaults' => array(
       								'controller' => 'Application\Controller\Index',
       								'action'     => 'search',
       						),
       				),
       		),
       		'contact' => array(
       				'type' => 'Zend\Mvc\Router\Http\Literal',
       				'options' => array(
       						'route'    => '/contact',
       						'defaults' => array(
       								'controller' => 'Application\Controller\Contact',
       								'action'     => 'index',
       						),
       				),
       		),
       		'submitContact' => array(
       				'type' => 'Zend\Mvc\Router\Http\Literal',
       				'options' => array(
       						'route'    => '/submit-contact',
       						'defaults' => array(
       								'controller' => 'Application\Controller\Contact',
       								'action'     => 'submitContact',
       						),
       				),
       		),
       		'submitNewsLetter' => array(
       				'type' => 'Zend\Mvc\Router\Http\Literal',
       				'options' => array(
       						'route'    => '/submit-newsletter',
       						'defaults' => array(
       								'controller' => 'Application\Controller\Contact',
       								'action'     => 'submitNewsLetter',
       						),
       				),
       		),
        	'projects' => array(
        			'type' => 'Zend\Mvc\Router\Http\Segment',
       				'options' => array(
       						'route'    => '/projects[/:id]',
       						'constraints' => array(
       							'id'=>'[0-9]+',
       						),
       						'defaults' => array(
       								'controller' => 'Application\Controller\Project',
       								'action'     => 'index',
       						),
       				),
       		),
       		'project-details' => array(
       				'type' => 'Zend\Mvc\Router\Http\Segment',
       				'options' => array(
       						'route'    => '/project-details[/:projectId]',
       						'constraints' => array (
       								'projectId' => '[0-9]+'
       						),
       						'defaults' => array(
       								'controller' => 'Application\Controller\Project',
       								'action'     => 'details',
       						),
       				),
       		),
       		
       		'services' => array(
       				'type' => 'Zend\Mvc\Router\Http\Literal',
       				'options' => array(
       						'route'    => '/services',
       						'defaults' => array(
       								'controller' => 'Application\Controller\Service',
       								'action'     => 'index',
       						),
       				),
       		),
       		'service-details' => array(
       				'type' => 'Zend\Mvc\Router\Http\Segment',
       				'options' => array(
       						'route'    => '/service-details[/:serviceId]',
       						'constraints' => array (
       								'serviceId' => '[0-9]+'
       						),     						
       						'defaults' => array(
       								'controller' => 'Application\Controller\Service',
       								'action'     => 'details',
       						),
       				),
       		),
       		
       		'news' => array(
       				'type' => 'Zend\Mvc\Router\Http\Literal',
       				'options' => array(
       						'route'    => '/news',
       						'defaults' => array(
       								'controller' => 'Application\Controller\News',
       								'action'     => 'index',
       						),
       				),
       		),
       		'news-details' => array(
       				'type' => 'Zend\Mvc\Router\Http\Segment',
       				'options' => array(
       						'route'    => '/news-details[/:newsId]',
       						'constraints' => array (
       								'newsId' => '[0-9]+'
       						),
       						'defaults' => array(
       								'controller' => 'Application\Controller\News',
       								'action'     => 'details',
       						),
       				),
       		),
       		'products' => array(
       				'type' => 'Zend\Mvc\Router\Http\Literal',
       				'options' => array(
       						'route'    => '/products',
       						'defaults' => array(
       								'controller' => 'Application\Controller\Product',
       								'action'     => 'index',
       						),
       				),
       		),
       		'products-details' => array(
       				'type' => 'Zend\Mvc\Router\Http\Segment',
       				'options' => array(
       						'route'    => '/product-details[/:productId]',
       						'constraints' => array (
       								'productId' => '[0-9]+'
       						),
       						'defaults' => array(
       								'controller' => 'Application\Controller\Product',
       								'action'     => 'details',
       						),
       				),
       		),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
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
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
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
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Contact' => 'Application\Controller\ContactController',
            'Application\Controller\Page' => 'Application\Controller\PageController',
            'Application\Controller\Section' => 'Application\Controller\SectionController',
            'Application\Controller\Page' => 'Application\Controller\PageController',
            'Application\Controller\Project' => 'Application\Controller\ProjectController',
            'Application\Controller\Service' => 'Application\Controller\ServiceController',
            'Application\Controller\News' => 'Application\Controller\NewsController',
            'Application\Controller\Product' => 'Application\Controller\ProductController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
