<?php
namespace ZUMStats;
use Nette;

/**
 * Tabulka user
 */
class ScoreRepository extends Repository
{
    public function findTop($limit = 15)
    {
        return $this->getTable()->order("result DESC")->limit($limit);
    }
    
    public function commitScore($userId, $score)
    {
        $this->getTable()->insert(array(
            "user_id" => $userId,
            "result" => $score,
            "date" => new Nette\DateTime()
        ));
    }
}