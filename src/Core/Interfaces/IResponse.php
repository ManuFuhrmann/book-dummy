<?php

namespace Manuel\Core\Interfaces;

interface IResponse
{
    public function setData(array $data);

    public function __toString(): string;
}