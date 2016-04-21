<?php


namespace Application\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Form\MartandFormFilter;

class MartandFormFilterFactory implements FactoryInterface
{
    
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $filter = new MartandFormFilter();
        
        $filter->filter();
        
        return $filter;
    }

}