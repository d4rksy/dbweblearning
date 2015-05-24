<?php

namespace KaliUser\Service;

use Zend\Crypt\Password\Bcrypt;
use DbmsAuth\Entity\User;

class DbmsUserService
{

    /**
     * Static function for checking hashed passwords as required by Doctrine.
     *
     * @param  DbmsAuth\Entity\User   $user   Identity Object
     * @param  string $passwordGiven Password to verify
     * @return boolean
     */
    public static function verifyHashedPassword(User $user, $passwordGiven)
    {
        $bcrypt = new Bcrypt(array('cost' => 14));
        return $bcrypt->verify($passwordGiven, $user->getPassword());
    }

    /**
     * Encrypt password (Registration or ChangePassword)
     * @param  string $password String to encrypt
     * @return string Hashed password
     */
    public static function encryptPassword($password)
    {
        $bcrypt = new Bcrypt(array('cost' => 14));
        return $bcrypt->create($password);
    }

}