<?php
namespace ZUMStats;
use Nette;

/**
 * Tabulka user
 */
class TokenRepository extends Repository
{
    public function updateToken($tokenString, $user)
    {
        $this->getTable()->where(array("user_id"=>$user))->delete();
        $this->getTable()->insert(
                array(
                    "token"=>$tokenString,
                    "user_id"=>$user,
                    "generated"=>new Nette\DateTime(),
                    "last_used"=>new Nette\DateTime())
                );
    }
    
    public function checkToken($tokenString, $interval = null)
    {
        $token = $this->findBy(array("token"=>$tokenString))->fetch();
        
        if($token)
        {
            if( $interval != null && Nette\DateTime::from($token->last_used)->add($interval) > (new Nette\DateTime()) )
                throw new \ZUMStats\Exceptions\CheckLimitExceededException();
            
            return $token->user_id;
        }
        else return null;
    }
}