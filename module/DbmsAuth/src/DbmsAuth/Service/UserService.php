<?php

namespace DbmsAuth\Service;

use Zend\Crypt\Password\Bcrypt;
use DbmsAuth\Entity\User;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;

class UserService implements ServiceManagerAwareInterface
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

    protected $authService;

    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * Set service manager instance
     *
     * @param ServiceManager $serviceManager
     * @return User
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    /**
     * getAuthService
     *
     * @return AuthenticationService
     */
    public function getAuthService()
    {
        if (null === $this->authService) {
            $this->authService = $this->getServiceManager()->get('Zend\Authentication\AuthenticationService');
        }
        return $this->authService;
    }

    /**
     * setAuthenticationService
     *
     * @param AuthenticationService $authService
     * @return User
     */
    public function setAuthService(AuthenticationService $authService)
    {
        $this->authService = $authService;
        return $this;
    }

}