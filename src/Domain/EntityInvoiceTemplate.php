<?php

namespace Manuel\Domain;

use Manuel\Core\Entity;

class EntityInvoiceTemplate extends Entity
{
    public int $Id = 0;
    public string $Name = '';
    public string $Text = '';
    public bool $ShowAmount = false;
    public bool $ShowTimespan = false;
    public bool $ShowSum = false;
    public bool $Active = false;

    public function getId(): string
    {
        return $this->Id;
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