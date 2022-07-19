<?php

namespace Manuel\Core\Interfaces;

interface IRequest
{
    public function get(string $key): string;
}