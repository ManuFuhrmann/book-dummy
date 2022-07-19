<?php

namespace Manuel\Core\Interfaces;

use Manuel\Core\Entity;

interface IEntity
{
    public function __construct(array $raw = array());
    public function getId(): string;
    public function asArray(): array;
}