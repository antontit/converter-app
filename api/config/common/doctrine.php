<?php

use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

return [
    EntityManagerInterface::class => function (ContainerInterface $container) {
        $params = $container['config']['doctrine'];
        $config = Setup::createAnnotationMetadataConfiguration(
            $params['metadata_dirs'],
            $params['dev_mode'],
            $params['cache_dir'],
            new FilesystemCache(
                $params['cache_dir']
            ),
            false
        );
        return EntityManager::create(
            $params['connection'],
            $config
        );
    },

    'config' => [
        'doctrine' => [
            'dev_mode' => false,
            'cache_dir' => 'var/cache/doctrine',
            'metadata_dirs' => ['src/Model/User/Entity'],
            'connection' => [
                'url' => getenv('API_DB_URL'),
            ],
        ],
    ],
];