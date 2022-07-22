<?php

namespace Manuel\Infrastructure;

use Manuel\Core\Interfaces\IConnection;
use Manuel\Core\Interfaces\IEntity;
use Manuel\Core\Interfaces\IRepository;
use Manuel\Core\PrimaryKey;
use Manuel\Domain\EntityInvoiceTemplate;


final class RepositoryMemoryInvoiceTemplate implements IRepository
{
    private IConnection $connection;
    private array $memory = array();

    public function __construct(IConnection $connection)
    {
        //$this->connection = $connection;

        $this->memory[1] = new EntityInvoiceTemplate(array(
            'Id' => 1,
            'Name' => 'foo',
            'Text' => '$$DESCRIPTION$$',
            'ShowAmount' => 1,
            'ShowTimespan' => 1,
            'ShowSum' => 1,
            'Active' => 1,
        ));
        $this->memory[2] = new EntityInvoiceTemplate(array(
            'Id' => 2,
            'Name' => 'bar',
            'Text' => '$$DESCRIPTION$$',
            'ShowAmount' => 1,
            'ShowTimespan' => 1,
            'ShowSum' => 1,
            'Active' => 1,
        ));
    }

    public function save(IEntity $entity): int
    {
        $this->memory[$entity->getId()] = $entity;
        return $entity->getId();
    }

    public function getById(PrimaryKey $primKey): IEntity
    {
        return $this->memory[$primKey->getId()];
    }

    public function nextIdentity(): PrimaryKey
    {
        return count($this->memory);
    }
}