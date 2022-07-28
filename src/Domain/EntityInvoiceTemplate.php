<?php

namespace Manuel\Domain;

use Manuel\Core\Entity;
use Manuel\Core\PrimaryKey;
use Manuel\Core\PrimaryKeyStandard;

class EntityInvoiceTemplate extends Entity
{
    public PrimaryKeyStandard $primKey;
    public string $Name = '';
    public string $Text = '';
    public bool $ShowAmount = false;
    public bool $ShowTimespan = false;
    public bool $ShowSum = false;
    public bool $Active = false;

    public function getPK(): PrimaryKey
    {
        return $this->primKey;
    }

    public function setPK(PrimaryKey $primaryKey)
    {
        $this->primKey = $primaryKey;
    }

    public function getId(): string
    {
        return $this->primKey->getId();
    }

    public function setInactive(): bool
    {
        if ($this->Active) {
            $this->Active = false;
            return true;
        }
        return false;
    }
}