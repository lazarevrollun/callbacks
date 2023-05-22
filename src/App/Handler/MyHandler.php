<?php

declare(strict_types=1);

namespace App\Handler;

use App\Callbacks\UpdateOrderCallbackInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;
use rollun\callback\Callback\Interrupter\InterrupterInterface;
use rollun\callback\Callback\SerializedCallback;

class MyHandler implements RequestHandlerInterface
{
    public function __construct(
        private LoggerInterface $logger,
        private UpdateOrderCallbackInterface $callback,
        private InterrupterInterface $interrupter)
    {

    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        call_user_func($this->interrupter, 5);

        $this->logger->notice("Привіт світ!");
        return new HtmlResponse("res");
    }
}
