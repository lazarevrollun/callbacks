<?php

namespace App\Callbacks;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class UpdateOrderCallbackFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): UpdateOrderCallback
    {
        $logger = $container->get(LoggerInterface::class);
        $dataStore = $container->get('dataStore');
        return new UpdateOrderCallback($logger, $dataStore);
    }
}