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
            $this->redirect("Score:");
        }
    }
    
    public function renderDefault()
    {
        $this->redirect("list");
    }

    public function renderList()
    {
        $top = $this->scoreRepository->findTop(30);
        $userCount = 5;
        $users = array();
        $top_users = $top->fetchAll();
        foreach($top_users as $score) {
            $users[] = $score->name;
            if($userCount == count($users)) break;
        }
        $this->template->scores = $top_users;
        $this->template->chart = $this->scoreRepository->findTimeStats($users,30,5);
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
        
        $this->redirect("Score:");
    }
    
}
?>
