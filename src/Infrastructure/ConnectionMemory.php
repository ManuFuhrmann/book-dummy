<?php

namespace Manuel\Infrastructure;

use Manuel\Core\Interfaces\IConnection;
use Manuel\Core\Interfaces\IEntity;
use Manuel\Core\PrimaryKey;

class ConnectionMemory implements IConnection
{
    private array $records;

    public function insert(string $group, array $data): PrimaryKey
    {
        return array_push($this->records[$group], $data);
    }

    public function select(string $group, array $data = array(), array $where = array(), array $order = array(), int $limit = -1, int $offset = 0): IEntity
    {
        return $this->records[$group];
    }

    public function update(string $group, array $data, array $where = array()): PrimaryKey
    {
        return 0;
    }

    public function delete(string $group, array $where = array()): PrimaryKey
    {
        return 0;
    }
}