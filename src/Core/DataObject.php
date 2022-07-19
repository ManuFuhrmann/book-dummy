<?php

namespace Manuel\Core;

use Manuel\Interfaces\Connection;

abstract class DataObject
{
    protected Connection $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }
}