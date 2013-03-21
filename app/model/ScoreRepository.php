<?php
namespace ZUMStats;
use Nette;

/**
 * Tabulka user
 */
class ScoreRepository extends Repository
{
    public function findTop($limit = NULL, $byUser = NULL)
    {
        $select = $this->connection->table('results')->select('score_id, count(*)');
                
        if($byUser) $select->where("score_id.user_id", $byUser);
        
        return $select->group('score_id')->order('`count(*)` ASC')->limit($limit);
    }
    
    protected function removeEdges($nodeId, &$edges)
    {
        foreach($edges as $key=>$value)
        {
            if($value['from_id'] == $nodeId || $value['to_id'] == $nodeId) unset($edges[$key]);
        }
    }
    
    protected function checkScore($score)
    {
        $edges = $this->connection->table('edge');
        
        $fEdges = array();
        foreach($edges as $edge)
        {
            $fEdges[$edge->id] = array("from_id"=>$edge->from_id, "to_id"=>$edge->to_id);
        }
        
        foreach($score as $node)
        {
            $this->removeEdges($node, $fEdges);
        }
        
        return $fEdges;
    }
    
    public function commitScore($userId, $score)
    {
        $nodesCount = $this->connection->table('node')->count();
        
        if($nodesCount < count($score))
            throw new \ZUMStats\Exceptions\TooMuchNodesException("Moc uzlu - ".$nodesCount);
        
        $checkScore = $this->checkScore($score);
        if(count($checkScore) != 0)
                    throw new \ZUMStats\Exceptions\InvalidScoreException("Nebylo pokryto ".$checkScore." uzlu.");
        
        $this->getTable()->insert(array("user_id"=>$userId, "date"=>new Nette\DateTime()));
        $scoreId = $this->connection->lastInsertId();
        
        $final = array();
        foreach($score as $node)
        {
            array_push($final, array("score_id"=>$scoreId, "node_id"=>$node));
        }
        
        $this->connection->table('results')->insert($final);
    }
    
    public function changeState($id)
    {
        $score = $this->getTable()->get($id);
        
        if($score)
        {
            $score->update(array("valid" => (!$score->valid)));
        }
    }
    
    public function delete($id)
    {
        $score = $this->getTable()->get($id);
        
        if($score) $score->delete();
    }
}