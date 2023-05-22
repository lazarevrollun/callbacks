<?php

namespace App\Callbacks;

interface UpdateOrderCallbackInterface
{
    public function __invoke($value);
}