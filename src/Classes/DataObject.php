<?php

namespace Manuel\Core\Classes;

use Manuel\Core\Interfaces\Connection;

class DataObject
{
    protected Connection $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }
}