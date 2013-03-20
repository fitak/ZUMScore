<?php

use Nette\Application\UI;

/**
 * Description of ScorePresenter
 *
 * @author Jenda
 */

class APIPresenter extends BasePresenter
{
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
    }
    
    public function actionCommit($score, $token)
    {
        $userId = $this->tokenRepository->findBy(array("token"=>$token))->fetch();
        
        if($userId)
        {
            $this->scoreRepository->commitScore($userId->user_id, $score);
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
