<?php

use Nette\Application\UI,
    Nette\ComponentModel\IContainer;

class CommitScoreForm extends UI\Form
{
    public function __construct(IContainer $parent = NULL, $name = NULL)
    {
        parent::__construct($parent, $name);
                
        $this->addTextArea("nodes", "Seznam uzlů oddělený čárkami")->setAttribute('style', 'width: 95%;');
        $this->addSubmit('commit', 'Commit!')->setAttribute('class', 'btn btn-primary btn-large');        
    }
    
}