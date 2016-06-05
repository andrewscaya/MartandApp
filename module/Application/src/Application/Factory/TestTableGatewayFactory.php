<?php

namespace Application\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Model\TestTableGateway;

class TestTableGatewayFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $tableGateway = new TestTableGateway('testtable', $serviceManager->get('general-adapter'));

        return $tableGateway;
    }
}
