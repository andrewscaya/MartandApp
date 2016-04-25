<?php

namespace Application\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;

class MartandFormFilter extends InputFilter
{
    
    public function buildFilter()
    {
        $firstname = new Input('fname');
        
        $firstname->getValidatorChain()
                  ->attachByName('StringLength', array('min' => 1, 'max' => 30));
        
        $this->add($firstname);
    }
    
}