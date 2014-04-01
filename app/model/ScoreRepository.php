<?php

namespace ZUMStats;

use Nette;

/**
 * Tabulka user
 */
class ScoreRepository extends Repository {

    public function getUserResults($byUser = NULL, $limit = NULL) {
        $select = $this->connection->table('results')->select('score_id, count(*)');

        if ($byUser)
            $select->where("score_id.user_id", $byUser);

        $select = $select->group('score_id')->order('`count(*)` ASC');

        return $select->limit($limit);
    }

    /**
     * returns user data ordered by date
     * @param int $byUser
     * @return type
     */
    public function getUserChart($byUser) {
        $select = $this->connection->table('results')->select('score_id, count(*)')
                        ->where("score_id.user_id", $byUser)->group('score_id')->order('date');

        return $select;
    }

    public function findTop($limit = NULL, $byUser = NULL) {
        // OH DEAR, THIS IS AN AWFUL PIECE OF SHIT!
        $result = $this->connection->query("select *, min(sub_nodes_count) as min_nodes_count " .
                "from (select score_id, count(*) as sub_nodes_count " .
                "from results sr group by score_id) tr left join score s on tr.score_id = s.id " .
                "left join users on s.user_id = users.id group by user_id order by min_nodes_count");

        //unset($result->password);

        return $result;
    }

    public function findTimeStats($samples = 30, $max_days = 5) {

        $top = $this->findTop(30);
        $top_users = $top->fetchAll();

        $users = array();

        foreach($top_users as $score) {
            $users[] = $score->name;
            if(count($users) == 5) break;
        }

        if(!count($users)) {
            return array('users' => array(), 'times' => array());
        }

        list($min, $max) = $this->findDates();

        $times = array();
        $days = $max_days*24*60*60;
        if($max - $min > $days){
            $min = $max - $days;
        }
        $duration = ($max - $min);
        $step = $duration / $samples;
        for ($stamp = $min; $stamp <= $max + $step; $stamp+=$step) {
            $date = Date("Y-m-d H:i:s", $stamp);
            $counts = array();
            foreach ($users as $user) {
                $result = $this->connection->query(
                                "SELECT count(score_id) as count FROM score LEFT JOIN results ON results.score_id = score.id
                                INNER JOIN users ON score.user_id = users.id
                                WHERE date <= ? AND users.name = ?
                                GROUP BY score.id
                                ORDER BY date DESC
                                LIMIT 1
                                ",$date,$user)
                        ->fetch();
                $counts[] = $result ? $result->count : 'null';
            }
            $times[] = array('date' => $stamp, 'scores' => $counts);
        }
        return array('users' => $users, 'times' => $times);
    }

    protected function findDates() {
        $dates = $this->connection->table('score')->select('id, MIN(date) AS min, MAX(date) AS max')->limit(1)->fetch();
        return array(strtotime($dates->min), strtotime($dates->max));
    }

    protected function removeEdges($nodeId, &$edges) {
        foreach ($edges as $key => $value) {
            if ($value['from_id'] == $nodeId || $value['to_id'] == $nodeId)
                unset($edges[$key]);
        }
    }

    protected function checkScore($score) {
        $offset = 0;
        $limit = 1000;

        $edges = $this->connection->table('edge')->limit($limit, $offset);
        $offset += $limit;

        $spare_edges = array();

        while(count($edges)) {
            $edges = $this->connection->table('edge')->limit($limit, $offset);

            $fEdges = array();
            foreach ($edges as $edge) {
                $fEdges[$edge->id] = array("from_id" => $edge->from_id, "to_id" => $edge->to_id);
            }

            foreach ($score as $node) {
                $this->removeEdges($node, $fEdges);
            }
                
            $spare_edges = array_merge($spare_edges, $fEdges);
            $offset += $limit;
        }

        return $spare_edges;
    }

    public function commitScore($userId, $score) {
        $nodesCount = $this->connection->table('node')->count();

        if ($nodesCount < count($score))
            throw new \ZUMStats\Exceptions\TooMuchNodesException("Moc uzlu - " . $nodesCount);

        $checkScore = $this->checkScore($score);
        if (count($checkScore) != 0)
            throw new \ZUMStats\Exceptions\InvalidScoreException("Nebylo pokryto " . count($checkScore) . " hran.", $checkScore);

        $this->getTable()->insert(array("user_id" => $userId, "date" => new Nette\DateTime()));
        $scoreId = $this->connection->lastInsertId();

        $final = array();
        foreach ($score as $node) {
            array_push($final, array("score_id" => $scoreId, "node_id" => $node));
        }

        $this->connection->table('results')->insert($final);
    }

    public function getScore($id) {
        $nodes = $this->connection->table('results')->select('node_id')->where('score_id', $id);
        $score = $this->getTable()->get($id);

        return new Score($score, $nodes);
    }

    public function changeState($id) {
        $score = $this->getTable()->get($id);

        if ($score) {
            $score->update(array("valid" => (!$score->valid)));
        }
    }

    public function delete($id) {
        $score = $this->getTable()->get($id);

        if ($score)
            $score->delete();
    }

}
