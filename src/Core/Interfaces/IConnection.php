<?php

namespace Manuel\Core\Interfaces;

interface IConnection
{
    public function select(string $group, array $data = array(), array $where = array(), array $order = array(), int $limit = -1, int $offset = 0) : array;
    public function insert(string $group, array $data) : int;
    public function update(string $group, array $data, array $where = array()) : int;
    public function delete(string $group, array $where = array()): int;
}