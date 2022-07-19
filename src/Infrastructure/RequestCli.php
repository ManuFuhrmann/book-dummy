<?php

namespace Manuel\Infrastructure;

use Manuel\Core\Interfaces\IRequest;

class RequestCli implements IRequest
{

    /**
     * @throws \Exception
     */
    public function get(string $key): string
    {
        if (isset($argv[$key])) {
            return $argv[$key];
        } else {
            throw new \Exception('unknown request param');
        }
    }
}