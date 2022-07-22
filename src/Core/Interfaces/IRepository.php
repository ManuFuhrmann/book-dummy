<?php

namespace Manuel\Core\Interfaces;

use Manuel\Core\Exceptions\CouldNotCreateInvoice;
use Manuel\Core\Exceptions\CouldNotFindInvoice;
use Manuel\Core\PrimaryKey;

interface IRepository
{
    public function __construct(IConnection $connection);

    /**
     * @param IEntity $entity
     * @return void
     * @throws CouldNotCreateInvoice
     */
    public function save(IEntity $entity): int;

    /**
    * @throws CouldNotFindInvoice
    */
    public function getById(PrimaryKey $primKey): IEntity;

    public function nextIdentity(): PrimaryKey;

}