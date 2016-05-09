<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\MvcEvent;
use Zend\Mvc\ModuleRouteListener;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

class Module
{
    
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                getcwd() . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
    {
        return array(
            'services' => array(
                'db-params' => array(
                    'driver'         => 'pdo_mysql',
                    'host'           => 'localhost',
                    'dbname'         => 'test',
                    'user'           => 'testuser',
                    'password'       => 'password',
                    'driver_options' => array(
                        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
                        // NOTE: change to PDO::ERRMODE_SILENT for production!
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING)
                ),
                'doctrine-entity-paths' => array(
                    __DIR__ . '/src/Application/Entity',
                ),
            ),
            'invokables' => array(
                'testtable-entity'   => 'Application\Entity\Testtable',
            ),
            'factories' => array(
                'doctrine-entity-manager' => function ($sm) {
                        $driver = new AnnotationDriver(new AnnotationReader(),
                                    $sm->get('doctrine-entity-paths')
                                );
                        AnnotationRegistry::registerLoader('class_exists');
                        $config   = Setup::createConfiguration(TRUE);
                        $config->setMetadataDriverImpl($driver);
                        return EntityManager::create($sm->get('db-params'), $config);
                    },
            ),
        );
    }
    
}
