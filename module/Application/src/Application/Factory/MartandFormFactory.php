<?php

namespace Application\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Form\MartandForm;

class MartandFormFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new MartandForm();
        
        $form->setInputFilter($serviceLocator->get('form-filter'));
        
        $form->buildForm();
        
        return $form;
    }
    
}
