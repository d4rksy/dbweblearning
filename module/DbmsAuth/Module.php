<?php
namespace DbmsAuth;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'aliases' => array(
                'doctrine_em' => 'doctrine.entitymanager.orm_default'
            ),
            'invokables' => array(
                'dbms_user_service' => 'DbmsAuth\Service\UserService'
            )

        );

    }
}
