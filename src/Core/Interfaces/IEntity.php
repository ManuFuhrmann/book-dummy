<?php

namespace Manuel\Core\Interfaces;

use Manuel\Core\Entity;
use Manuel\Core\PrimaryKey;

interface IEntity
{
    public function __construct(array $raw = array());
    public function getPK(): PrimaryKey;
    public function setPK(PrimaryKey $primaryKey);
    public function asArray(): array;
}