<?php

namespace Manuel\Infrastructure;


use Manuel\Core\Interfaces\IRepository;
use Manuel\Core\Interfaces\IConnection;
use Manuel\Core\Interfaces\IEntity;
use Manuel\Domain\EntityInvoice;

final class RepositorySqlInvoiceTemplate implements IRepository
{
    private IConnection $connection;

    public function __construct(IConnection $connection)
    {
        $this->connection = $connection;
    }

    public function save(IEntity $invoiceTemplate): int
    {
        $data = $invoiceTemplate->asArray();
        $columns = array_keys($data);
        $values = array_map(
            fn ($value) => $this->connection->escape($value),
            array_values($data)
        );
        $sql = 'INSERT INTO orders (' . implode(', ', $columns) . ') VALUES (' . implode(', ', $values) . ')';
        $this->connection->execute($sql);

        $lastInsertedId = $this->connection->execute('SELECT LAST_INSERT_ID();')->fetchColumn(0);
        return (int) $lastInsertedId;
    }

    public function getById(int $primKey): EntityInvoice
    {
        $record = $this->connection->execute(
            'SELECT * FROM invoices WHERE id = ?',
            [
                $primKey
            ]
        )->fetchAssoc();
        if ($record === false) {
            throw CouldNotFindEbook::withId($primKey);
        }
        return new EntityInvoice(
            $primKey,
            (int)$record['price']
        );
    }

    public function nextIdentity(): int
    {
        return (int)$this->connection->execute('SELECT MAX(id) AS highestId FROM invoices')->fetchColumn(0) + 1;
    }
}