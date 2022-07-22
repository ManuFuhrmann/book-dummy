<?php

namespace Manuel\Core\Interfaces;

use Manuel\Core\PrimaryKey;

interface IConnection
{
    public function select(string $group, array $data = array(), array $where = array(), array $order = array(), int $limit = -1, int $offset = 0) : IEntity;
    public function insert(string $group, array $data) : PrimaryKey;
    public function update(string $group, array $data, array $where = array()) : PrimaryKey;
    public function delete(string $group, array $where = array()): PrimaryKey;
}