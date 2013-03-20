<?php

use Nette\Application\UI,
    Nette\ComponentModel\IContainer;

class SignInForm extends UI\Form
{
    public function __construct(IContainer $parent = NULL, $name = NULL)
    {
        parent::__construct($parent, $name);
        $this->addText('result', 'Výsledek');
        $this->addSubmit('commit', 'Uložit');
    }
    
}