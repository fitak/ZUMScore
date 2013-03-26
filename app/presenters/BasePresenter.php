<?php

/**
 * Base presenter for all application presenters.
 */
use Nette\Application\UI\Form;

abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    /** @var ZUMStats\ScoreRepository */
    private $scoreRepository;
    
    protected function startup()
    {
        parent::startup();
        $this->scoreRepository = $this->context->scoreRepository;
    }
}
