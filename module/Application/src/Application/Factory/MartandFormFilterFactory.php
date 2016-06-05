<?php
namespace Application\Factory;

use Application\Form\MartandFormFilter;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MartandFormFilterFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $filter = new MartandFormFilter();

        $filter->buildFilter();

        return $filter;
    }
}
