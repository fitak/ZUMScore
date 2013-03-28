<?php

/**
 * Description of UserScoreList
 *
 * @author Jenda
 */

class UserScoreList extends BaseScoreList {
    
    private $limit = NULL;
    
    public function __construct($userRepository, $scoreRepository)
    {
        parent::__construct($userRepository, $scoreRepository);
    }
    
    public function render($userId, $renderGraph = true, $renderTable = true, $limit = NULL)
    {
        $template = $this->template;
        
        $template->setFile(__DIR__.'/templates/userList.latte');
        $template->renderTable = $renderTable;
        $template->renderGraph = $renderGraph;
        
        $this->template->userId = $userId;
        $this->template->scores = $this->scoreRepository->getUserResults($userId, $limit);
        $this->template->chart = $this->scoreRepository->getUserChart($userId);
        
        $template->render();
    }
}

?>
