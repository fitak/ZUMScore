<?php

use Nette\Caching\Cache;

/**
 * Description of ScoreOverview
 *
 * @author Jenda
 */
class ScoreOverview extends BaseScoreList {

    public function __construct($userRepository, $scoreRepository)
    {
        parent::__construct($userRepository, $scoreRepository);
    }
    
    public function render($renderButtons = false, $renderGraph = true, $renderTable = true, $limit = NULL)
    {
        $template = $this->template;
        
        $template->setFile(__DIR__.'/templates/overviewList.latte');
        $template->renderTable = $renderTable;
        $template->renderGraph = $renderGraph;
        $template->renderButtons = $renderButtons;
                
        $this->template->scores = $this->scoreRepository->findTop($limit)->fetchAll();
        
        $cache = new Cache($this->getPresenter()->context->cacheStorage, 'graf');
        $scoreRepo = $this->scoreRepository;
        $this->template->chart = $cache->load('graf', 
                                               function() use ($scoreRepo) {
                                                    return $scoreRepo->findTimeStats(30,5);
                                               }, 
                                               array(
                                                 Cache::EXPIRE => '+ 30 minutes', 
                                               )
                                             );
        
        $template->render();
    }
    
}

?>
