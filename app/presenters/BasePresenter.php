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
        
        $themeName = NULL;
        
        if($this->session->hasSection('theme'))
        {
            $theme = $this->getSession('theme');
            $themeName = $theme->themeName;
        }
        
        $this->template->themeName = $themeName;
    }
    
    public function createComponentThemeSwitcher()
    {
        $control = new ThemeSwitcher(array(
            NULL=>"Basic",
            "amelia"=>"Amelia",
            "cosmo"=>"Cosmo",
            "readable"=>"Readable"));
        
        return $control;
    }
}
