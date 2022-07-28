<?php

namespace Manuel\Core\Interfaces;

use Manuel\Core\PrimaryKey;

interface IConnection
{
    public function select(string $group, array $where = array(), array $order = array(), int $limit = -1, int $offset = 0) : array;
    public function insert(string $group, IEntity $data) : PrimaryKey;
    public function update(string $group, array $where = array(), array $data) : array;
    public function delete(string $group, array $where = array()): int;
}