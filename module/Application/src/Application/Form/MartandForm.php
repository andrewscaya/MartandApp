<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\Form\Element\Submit;

class MartandForm extends Form
{
    public function buildForm()
    {
        $fname = new Text('fname');
        $fname->setLabel('First name: ')
              ->setAttributes(
                  [
                      'size'        => 40,
                      'maxlength'   => 30,
                      'required'    => 'required',
                      'placeholder' => 'Please enter your first name to register',
                  ]
              );
        
        $submit = new Submit('submit');
        $submit->setAttributes(['value' => 'Envoyer']);
        
        $this->add($fname)
             ->add($submit);
    }
    
}
