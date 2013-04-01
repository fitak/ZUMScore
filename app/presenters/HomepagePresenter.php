<?php

use Nette\Application\UI;
use Nette\Caching\Cache;

/**
 * Description of HomepagePresenter
 *
 * @author Jenda
 */

class HomepagePresenter extends BasePresenter
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
    
    public function handleChangeValidity($id)
    {
        if($this->getUser()->isInRole("admin"))
            $this->scoreRepository->changeState($id);
    }
    
    public function handleDelete($id)
    {
        if($this->getUser()->isInRole("admin"))
            $this->scoreRepository->delete($id);
    }
    
    public function actionDisplayScore($id)
    {
        $this->template->userId = $id;
        if($this->getUser()->isInRole('admin') || $this->getUser()->getId() == $id)
        {
            $score = $this->scoreRepository->getScore($id);
            $this->template->nodes = $score->getNodes();        
        } else
        {
            $this->flashMessage("Nelze zobrazit cizí výsledek!");
            $this->redirect("Homepage:");
        }
    }
    
    public function renderDefault()
    {
    }
    
    protected function createComponentCommitScoreForm($name)
    {
        $form = new CommitScoreForm($this, $name);

        $form->setRenderer(new Kdyby\BootstrapFormRenderer\BootstrapRenderer());
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
            }
            catch(\ZUMStats\Exceptions\InvalidScoreException $e)
            {
                $this->flashMessage($e->getMessage(), "error");
                $this->template->uncoveredEdges = $e->getUncoveredEdges();
                return;
            }
            catch(\ZUMStats\Exceptions\ZUMException $e)
            {
                $this->flashMessage($e->getMessage(), "error");
                return;
            }    
            
            $this->flashMessage("Záznam byl uložen", "success");
        }
        
        $this->redirect("Homepage:");
    }
    
    public function createComponentScoreOverview()
    {
        $control = new ScoreOverview($this->usersRepository, $this->scoreRepository);
        
        return $control;
    }
    
}
?>
