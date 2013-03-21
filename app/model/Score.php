<?php

namespace ZUMStats;

class Score extends \Nette\Object
{
    private $nodes, $score;
    
    public function __construct($score, $nodes)
    {
        $this->score = $score;
        $this->nodes = $nodes;
    }
    
    public function getNodes()
    {
        return $this->nodes;
    }
    
    public function getScore()
    {
        return $this->score;
    }
    
    public function getNodesCount()
    {
        return count($this->nodes);
    }
}

?>
