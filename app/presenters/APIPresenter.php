<?php

use Nette\Application\UI;

/**
 * Description of ScorePresenter
 *
 * @author Jenda
 */

class APIPresenter extends BasePresenter
{
    private static $API_VERSION = 2;
    
    /** @var ZUMStats\ScoreRepository */
    private $scoreRepository;
    
    /** @var ZUMStats\UsersRepository */
    private $usersRepository;
    
    /** @var ZUMStats\TokenRepository */
    private $tokenRepository;
    
    protected function startup()
    {
        parent::startup();
        $this->scoreRepository = $this->context->scoreRepository;
        $this->usersRepository = $this->context->usersRepository;
        $this->tokenRepository = $this->context->tokenRepository;
        $this->payload->apiver = 2;
    }
    
    public function actionGetMyBest($apiversion, $token)
    {
        try {
            $userId = $this->tokenRepository->checkToken($token);
        } catch(ZUMStats\Exceptions\CheckLimitException $e)
        {
            $this->payload->success = false;
            $this->payload->message = "You can commit only one result per minute!";
            $this->sendPayload();
        }
        
        $this->payload->success=false;
        if($userId)
        {
            $result = $this->scoreRepository->getUserResults($userId, 1)->fetch();
            if($result)
            {
                $this->payload->score = $result['count(*)'];
                $this->payload->success = true;
            } else
            {
                $this->payload->message = "Cannot retrieve score.";
            }
        }
        $this->sendPayload();
    }
    
    public function actionCommit($apiversion, $token)
    {
        if(isset($_POST['score']))
            $score = $_POST['score'];
        else
        {
            $this->payload->success = false;
            $this->payload->message = "There is no score :(";
            $this->sendPayload();
        }
        
        try {
            $userId = $this->tokenRepository->checkToken($token);
        } catch(ZUMStats\Exceptions\CheckLimitException $e)
        {
            $this->payload->success = false;
            $this->payload->message = "You can commit only one result per minute!";
            $this->sendPayload();
        }
                
        if($userId)
        {
            $parsedScoreDecode = base64_decode($score);
            $parsedScoreTrimmed = trim($parsedScoreDecode, "[]");
            $tmpScoreArray = explode(",", $parsedScoreTrimmed);
            $scoreArray = array();
            
            foreach($tmpScoreArray as $node)
            {
                array_push($scoreArray, trim($node));
            }
            
            try{
                $this->scoreRepository->commitScore($userId, $scoreArray);
            } catch(\ZUMStats\Exceptions\ZUMException $e)
            {
                $this->payload->success = false;
                $this->payload->message = $e->getMessage();
                $this->sendPayload();
            }
            
            $this->payload->success = true;
            $this->payload->message = "Score saved!";
        } else {
            $this->payload->success = false;
            $this->payload->message = "Token is invalid (".$score.", ".$token.")";
        }
        
        $this->sendPayload();
    }
    
}
?>
