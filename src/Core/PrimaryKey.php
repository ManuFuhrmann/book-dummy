<?php

namespace Manuel\Core;

abstract class PrimaryKey
{
    protected array $primKey = array();

    public function getPk(): array
    {
        return $this->primKey;
    }

    public function setPk(array $primKey)
    {
        $this->primKey = $primKey;
    }
}