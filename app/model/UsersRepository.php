<?php
namespace ZUMStats;
use Nette;

/**
 * Tabulka user
 */
class UsersRepository extends Repository
{
    public static function calculateHash($password, $salt = NULL)
    {
            if ($password === Strings::upper($password)) { // perhaps caps lock is on
                    $password = Strings::lower($password);
            }
            return crypt($password, $salt ?: '$2a$07$' . Strings::random(22));
    }
    
    public function activateAccount($username)
    {
        $user = $this->findBy(array("name"=>$username))->fetch();
        
        $password = rand(10000, 99999);
        
        if($user)
        {
            if($user->active == 1) throw new \Exception("Tento uživatel je již aktivní");
            
            $user->update(array("password"=>md5($password)));
        } else
        {
            $this->getTable()->insert(array("name"=>$username, "password"=>md5($password), "active"=>1));
        }
        
        return $password;
    }
    
    public function changePassword($userId, $password)
    {
        $user = $this->findBy(array("id"=>$userId))->fetch();
        
        if($user)
        {
            $user->update(array("password"=>md5($password)));
        }
    }
    
    public function getUserDetails($id)
    {
        $user = $this->getTable()->get($id);
        unset($user->password);
        
        return($user);
    }
}