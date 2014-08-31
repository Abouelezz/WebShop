<?php
namespace Webshop;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\Config\SessionConfig;
use Zend\Session\Container;
use Zend\Session\SessionManager;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $sharedEvents        = $e->getApplication()->getEventManager()->getSharedManager();
        $sharedEvents->attach(
            __NAMESPACE__, 'dispatch', function($e) {
                $result = $e->getResult();
                if ($result instanceof \Zend\View\Model\ViewModel) {
                    $result->setTerminal(true);
                }
            }
            );
        $this->initSession(array(
            'remember_me_seconds' => 180,
            'use_cookies' => true,
            'cookie_httponly' => true,
            ));
    }

    public function getConfig()
    {
        return array(
            'router' => array(
                'routes' => array(
                    'home' => array(
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => array(
                            'route'    => '/',
                            'defaults' => array(
                                'controller' => 'Webshop\Controller\Index',
                                'action'     => 'index',
                                ),
                            ),
                        ),
                    'view' => array(
                        'type' => 'Zend\Mvc\Router\Http\segment',
                        'options' => array(
                            'route'    => '/view/:id',
                            'constraints' => array(
                                'id'     => '[0-9]+',
                                ),
                            'defaults' => array(
                                'controller' => 'Webshop\Controller\Index',
                                'action'     => 'view',
                                ),
                            ),
                        ),
                    'cart' => array(
                        'type' => 'Zend\Mvc\Router\Http\segment',
                        'options' => array(
                            'route'    => '/cart[/:action][/:id][/:qty]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'     => '[0-9]+',
                                'qty'     => '[0-9]+',
                                ),
                            'defaults' => array(
                                'controller' => 'Webshop\Controller\Cart',
                                'action'     => 'index',
                                ),
                            ),
                        ),
                    ),
),
'controllers' => array(
    'invokables' => array(
        'Webshop\Controller\Index'  => 'Webshop\Controller\IndexController',
        'Webshop\Controller\Cart'   => 'Webshop\Controller\CartController'
        ),
    ),
'view_manager' => array(
    'display_not_found_reason' => true,
    'display_exceptions'       => true,
    'doctype'                  => 'HTML5',
    'not_found_template'       => 'error/404',
    'exception_template'       => 'error/index',
    'template_path_stack' => array(
        __DIR__ . '/view',
        ),
    ),
);
}
public function initSession($config)
{
    $sessionConfig = new SessionConfig();
    $sessionConfig->setOptions($config);
    $sessionManager = new SessionManager($sessionConfig);
    $sessionManager->start();
    Container::setDefaultManager($sessionManager);
}

public function getAutoloaderConfig()
{
    return array(
        'Zend\Loader\StandardAutoloader' => array(
            'namespaces' => array(
                __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
}
}
