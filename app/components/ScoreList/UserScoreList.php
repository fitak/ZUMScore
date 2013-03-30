<?php

/**
 * Description of UserScoreList
 *
 * @author Jenda
 */

class UserScoreList extends BaseScoreList {

    public function __construct($userRepository, $scoreRepository)
    {
        parent::__construct($userRepository, $scoreRepository);
    }
    
    public function render($userId, $renderButtons = false, $renderGraph = true, $renderTable = true, $limit = NULL)
    {
        $template = $this->template;
        
        $template->setFile(__DIR__.'/templates/userList.latte');
        $template->renderTable = $renderTable;
        $template->renderGraph = $renderGraph;
        $template->renderButtons = $renderButtons;
        
        $this->template->userId = $userId;
        $this->template->scores = $this->scoreRepository->getUserResults($userId, $limit);
        $this->template->chart = $this->scoreRepository->getUserChart($userId);
        
        $this->template->presenter = $this->getPresenter();
        
        $template->render();
    }
    
}

?>
