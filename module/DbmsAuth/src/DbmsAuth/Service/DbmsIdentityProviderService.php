<?php


namespace DbmsAuth\Service;

use BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Simple authentication provider factory
 */
class DbmsIdentityProviderService implements FactoryInterface
{
    /**
     * Simple Auth factory copied from some tutorial, didn't bother to change a single line..
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $user                   = $serviceLocator->get('dbms_user_service');
        $simpleIdentityProvider = new AuthenticationIdentityProvider($user->getAuthService());
        $config                 = $serviceLocator->get('BjyAuthorize\Config');

        $simpleIdentityProvider->setDefaultRole($config['default_role']);
        $simpleIdentityProvider->setAuthenticatedRole($config['authenticated_role']);

        return $simpleIdentityProvider;
    }
}