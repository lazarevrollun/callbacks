<?php

namespace HelloUser\Controllers;

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class User1ControllerFactory
{
    function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        return new User1Controller($container->get(LoggerInterface::class));
    }
}