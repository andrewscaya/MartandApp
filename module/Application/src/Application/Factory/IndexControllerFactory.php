<?php

namespace Application\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Controller\IndexController;
use Zend\Db\Sql\Sql;

class IndexControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sm = $serviceLocator->getServiceLocator();
        $controller = new IndexController();
        $adapter = $sm->get('general-adapter');
        $controller->setAdapter($adapter);
        $controller->setSqlObject(new Sql($adapter));
        $controller->setTestTableGateway($sm->get('test-table-gateway'));
        $controller->setEntityManager($sm->get('doctrine-entity-manager'));
        $controller->setEntity($sm->get('testtable-entity'));
        $controller->setForm($sm->get('martand-form'));
        return $controller;
    }
}
