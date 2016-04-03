<?php

namespace Application\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Controller\IndexController;

class IndexControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sm = $serviceLocator->getServiceLocator();
        $controller = new IndexController();
        $controller->setAdapter($sm->get('general-adapter'));
        $controller->setTestTableGateway($sm->get('test-table-gateway'));
        $controller->setForm($sm->get('martand-form'));
        return $controller;
    }
}
