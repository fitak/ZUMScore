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
                    "generated"=>new Nette\DateTime())
                );
    }
}