<?php

namespace Manuel\Domain;

use Manuel\Core\Interfaces\IRequest;

class Request implements IRequest
{
    public function get(string $key): string
    {
        return $_REQUEST[$key];
    }
}