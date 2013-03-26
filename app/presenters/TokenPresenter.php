<?php

use Nette\Application\UI;

/**
 * Description of ScorePresenter
 *
 * @author Jenda
 */

class TokenPresenter extends BasePresenter
{
    /** @var ZUMStats\TokenRepository */
    private $tokenRepository;

    protected function startup()
    {
        parent::startup();
        $this->tokenRepository = $this->context->tokenRepository;
        
        if(!$this->getUser()->isLoggedIn()) $this->redirect("Score:");
    }
    
    public function actionDefault()
    {
        $token = $this->tokenRepository->findBy(array("user_id"=>$this->getUser()->getId()));
        
        if(count($token))
        {
            $this->template->token = $token->fetch()->token;
        }
    }
    
    public function handleGenerateToken()
    {
        $tokenString = md5($this->getUser()->getId().rand(0, 10000));
        $this->tokenRepository->updateToken($tokenString, $this->getUser()->getId());
        
        $this->template->token = $tokenString;
    }
    
}
?>
