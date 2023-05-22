<?php

declare(strict_types=1);

namespace App\Handler;

use App\Callbacks\UpdateOrderCallback;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;

class MyHandlerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): RequestHandlerInterface
    {
        $logger = $container->get(LoggerInterface::class);
        $callback = $container->get(UpdateOrderCallback::class);
        $interruptor = $container->get('processInterrupter');
        return new MyHandler($logger, $callback, $interruptor);
    }
}
