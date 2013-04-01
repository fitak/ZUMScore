<?php

use Nette\Application\UI,
    Nette\ComponentModel\IContainer;

class ResetPasswordForm extends UI\Form
{
    public function __construct(IContainer $parent = NULL, $name = NULL)
    {
        parent::__construct($parent, $name);
                
        $this->addText('email', 'Zadejte email');
        $this->addSubmit('reset', 'Reset hesla')->setAttribute('class', 'btn btn-primary btn-large');        
    }
    
}