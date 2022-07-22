<?php

namespace Manuel;

use Manuel\Core\PrimaryKey;

class PrimaryKeyStandard extends PrimaryKey
{
    private int $id = 0;

    public function __construct(int $id)
    {
        $this->setId($id);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}