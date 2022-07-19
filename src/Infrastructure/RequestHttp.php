<?php

namespace Manuel\Infrastructure;

use Manuel\Core\Interfaces\IRequest;

class RequestHttp implements IRequest
{
    public function get(string $key): string
    {
        if (isset($_REQUEST[$key])) {
            return $_REQUEST[$key];
        } else {
            throw new \Exception('unknown request param');
        }
    }
}