<?php

namespace HelloUser\Controllers;

use HelloUser\OpenAPI\V1\DTO\User;
use HelloUser\OpenAPI\V1\DTO\UserResult;
use Psr\Log\LoggerInterface;

class User1Controller
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function post($bodyData = null)
    {

        throw new \Exception('Not implemented method');
    }

    public function getById($id)
    {
        $user = new User();
        $user->id = $id;
        $user->name = 'Hello World';
        $userResult = new UserResult();
        $userResult->data = $user;
        $this->logger->notice("Привіт світ!$id;");
        return $userResult;
    }
}