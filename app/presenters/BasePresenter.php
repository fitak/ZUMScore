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
    
    protected function createCommitScoreForm()
    {
        $form = new CommitScoreForm();

        $form->onSuccess[] = callback($this, 'signInFormSubmitted');
        return $form;
    }
    
    protected function commitScoreSuccess(Form $form)
    {
        if($this->getUser()->isLoggedIn())
        {
            $this->scoreRepository->commitScore($this->getUser()->getId(), $form->getValues()->result);
            $this->payload->success = true;
            $this->payload->message = "Score saved!";
        }
        
        $this->redirect("Score:");
    }
    
}
