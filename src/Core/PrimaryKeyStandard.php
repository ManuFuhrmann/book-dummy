<?php

namespace Manuel\Core;

class PrimaryKeyStandard extends PrimaryKey
{
    public function __construct(int $id)
    {
        $this->setPk(array('id' => $id));
    }

    public function getId(): int
    {
        return $this->primKey['id'];
    }
}