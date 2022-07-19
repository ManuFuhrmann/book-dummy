<?php

namespace Manuel\Core;

use Manuel\Core\Interfaces\IEntity;

abstract class Entity implements IEntity
{
    public function __construct(array $raw = array())
    {
        foreach ($raw as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function asArray(): array
    {
        return get_object_vars($this);
    }
}