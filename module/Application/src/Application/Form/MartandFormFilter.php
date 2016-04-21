<?php

namespace Application\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;

class MartandFormFilter extends InputFilter
{
    
    public function filter()
    {
        
        $firstname = new Input('fname');
        $firstname->getValidatorChain()->attach(new \Zend\Validator\StringLength(6));
        
        $inputFilter = new InputFilter();
        $inputFilter->add($firstname)->setData($_POST);
        
        if ($inputFilter->isValid()) {
            echo 'The form is valid. <br />' . PHP_EOL;
        }
        else {
            echo 'The form is NOT valid. <br />' . PHP_EOL;
        }
        
    }
    
}