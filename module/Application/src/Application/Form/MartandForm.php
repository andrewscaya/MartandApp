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
        $fname->setLabel('Prénom')
              ->setAttributes(
                  [
                      'size'        => 40,
                      'maxlength'   => 30,
                      'required'    => 'required',
                      'placeholder' => 'Veuillez y inscrire votre prénom',
                  ]
              );
        
        $submit = new Submit('submit');
        $submit->setAttributes(['value' => 'Envoyer']);
        
        $this->add($fname)
             ->add($submit);
    }
    
}
