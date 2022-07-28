<?php

namespace Manuel\Domain;

use Manuel\Core\Entity;
use Manuel\Core\PrimaryKey;

class EntityUser extends Entity
{
    public PrimaryKey $primKey;
    public string $username = '';
    public string $password = '';
    public bool $active = false;

    public function getPk(): PrimaryKey
    {
        return $this->primKey;
    }

    public function setPk(PrimaryKey $primaryKey)
    {
        $this->primKey = $primaryKey;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername($username): string
    {
        $this->username = $username;
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword($password): string
    {
        $this->password = $password;
        return $this->password;
    }

    public function getActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): bool
    {
        $this->active = $active;
        return $this->active;
    }

    public function setInactive(): bool
    {
        if ($this->getActive()) {
            $this->setActive(false);
            return true;
        }
        return false;
    }
}