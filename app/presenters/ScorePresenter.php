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
    
}
?>
