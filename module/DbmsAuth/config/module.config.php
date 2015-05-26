<?php

namespace DbmsAuth;

return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'dbmsauth' => __DIR__ . '/../view',
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Authentication\AuthenticationService' => 'DbmsAuth\Service\Factory\AuthenticationFactory',
            'DbmsAuth\Provider\Identity\IdentityProvider' => 'DbmsAuth\Service\Factory\ProviderServiceFactory',
        ),
        'invokables'  => array(
            'DbmsAuth\View\RedirectionStrategy' => 'DbmsAuth\View\RedirectionStrategy',
        ),
    ),

    'doctrine' => array(
        'authentication' => array(
            'orm_default' => array(
                'object_manager' => 'Doctrine\ORM\EntityManager',
                'identity_class' => 'DbmsAuth\Entity\User',
                'identity_property' => 'username',
                'credential_property' => 'password',
                'credential_callable' => 'DbmsAuth\Service\UserService::verifyHashedPassword',
            ),
        ),
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver',
                )
            )
        ),
    ),

    'bjyauthorize' => array(
        // Using the authentication identity provider, which basically reads the roles from the auth service's identity
        'identity_provider' => 'DbmsAuth\Provider\Identity\AuthenticationIdentityProvider',

        'role_providers'        => array(
            // using an object repository (entity repository) to load all roles into our ACL
            'BjyAuthorize\Provider\Role\ObjectRepositoryProvider' => array(
                'object_manager'    => 'doctrine.entitymanager.orm_default',
                'role_entity_class' => 'DbmsAuth\Entity\Role',
            ),
        ),
    ),
);