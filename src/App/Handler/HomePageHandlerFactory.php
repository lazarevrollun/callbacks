<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HomePageHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $logger = 123;//$container->get(LoggerInterface::class);
        return new HomePageHandler($logger);
    }
}
