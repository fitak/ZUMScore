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
}