<?php

namespace Manuel\Infrastructure;

use Manuel\Core\Interfaces\IConnection;
use Manuel\Core\Interfaces\IEntity;
use Manuel\Core\PrimaryKey;

class ConnectionMemory implements IConnection
{
    private array $records;

    public function insert(string $group, IEntity $data): PrimaryKey
    {
        return array_push($this->records[$group], $data);
    }

    public function select(string $group, array $where = array(), array $order = array(), int $limit = -1, int $offset = 0): array
    {
        return $this->records[$group];
    }

    public function update(string $group, array $where = array(), array $data): array
    {
        return array();
    }

    public function delete(string $group, array $where = array()): int
    {
        return array();
    }
}