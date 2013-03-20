<?php

use Nette\Application\UI;

/**
 * Description of ScorePresenter
 *
 * @author Jenda
 */

class ScorePresenter extends BasePresenter
{
    /** @var ZUMStats\ScoreRepository */
    private $scoreRepository;
    
    /** @var ZUMStats\UsersRepository */
    private $usersRepository;

    protected function startup()
    {
        parent::startup();
        $this->scoreRepository = $this->context->scoreRepository;
        $this->usersRepository = $this->context->usersRepository;
    }
    
    public function renderDefault()
    {
        $this->redirect("list");
    }

    public function renderList()
    {
        $this->template->scores = $this->scoreRepository->findTop();
    }
    
    protected function createComponentCommitScoreForm()
    {
        $form = new UI\Form();

        $form->setRenderer(new Kdyby\BootstrapFormRenderer\BootstrapRenderer());

        $form->addTextArea("nodes", "Seznam uzlů oddělený čárkami")->setAttribute('style', 'width: 95%;');
        
        $form->addSubmit('commit', 'Commit!')->setAttribute('class', 'btn btn-primary btn-large');
        $form->onSuccess[] = callback($this, 'commitScoreSuccess');
        return $form;
    }
    
    public function commitScoreSuccess(UI\Form $form)
    {
        $values = $form->getValues();
        if($this->getUser()->isLoggedIn())
        {
            $parsedScoreTrimmed = trim($values->nodes, ", ");
            $tmpScoreArray = explode(",", $parsedScoreTrimmed);
            $scoreArray = array();
            
            foreach($tmpScoreArray as $node)
            {
                array_push($scoreArray, trim($node));
            }
            
            try{
                $this->scoreRepository->commitScore($this->getUser()->getId(), $scoreArray);
            } catch(\ZUMStats\Exceptions\ZUMException $e)
            {
                $this->flashMessage($e->getMessage(), "error");
                return;
            }    
            
            $this->flashMessage("Záznam byl uložen", "success");
        }
        
        $this->redirect("Score:");
    }
    
}
?>
