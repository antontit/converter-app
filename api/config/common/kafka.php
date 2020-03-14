<?php

use Psr\Container\ContainerInterface;
use Kafka\ProducerConfig;
use Kafka\ConsumerConfig;


return [

    ProducerConfig::class => function(ContainerInterface $container) {
        $params = $container->get('config')['kafka'];
        $config = ProducerConfig::getInstance();
        $config->setMetadataRefreshIntervalMs(10000);
        $config->setMetadataBrokerList($params['broker_list']);
        $config->setBrokerVersion('1.1.0');
        $config->setRequiredAck(1);
        $config->setIsAsyn(false);
        return $config;
    },

    ConsumerConfig::class => function(ContainerInterface $container) {
        $params = $container->get('config')['kafka'];
        $config = ConsumerConfig::getInstance();
        $config->setMetadataRefreshIntervalMs(10000);
        $config->setMetadataBrokerList($params['broker_list']);
        $config->setBrokerVersion('1.1.0');
        return $config;
    },


    'config' => [
        'kafka' => [
            'broker_list' => getenv('API_KAFKA_BROKER_LIST'),
        ],
    ],
];