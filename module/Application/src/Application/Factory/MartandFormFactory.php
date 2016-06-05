<?php

namespace Application\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Form\MartandForm;

class MartandFormFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $form = new MartandForm();

        $form->setInputFilter($serviceManager->get('martand-post-filter'));

        $form->buildForm();

        return $form;
    }
}
