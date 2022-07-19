<?php

namespace Manuel\Infrastructure;

use Manuel\Core\Interfaces\IConnection;
use PDO;

class ConnectionMySql implements IConnection
{
    private PDO $database;
    private array $records;

    public function __construct()
    {
        $host        = 'adp.cksastwdyphy.eu-west-1.rds.amazonaws.com';
        $user        = 'adpMaster';
        $password    = 'BSFAmuNcKezkdECC';
        $dbname      = 'adpoliceMasterDB1';

        $this->database = new PDO('mysql:dbname='.$dbname.';host='.$host.';charset=utf8', $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_zone = 'Europe/Berlin';"));
    }

    public function insert(string $group, array $data): int
    {
        $keys = array_keys($data);
        $values = array_keys($data);

        $sql = 'INSERT INTO ' . $group . '(' . implode(',', $keys) . ') VALUES (' . implode(',', $values) . ')';
        $stmt = $this->database->prepare($sql);
        $stmt->execute();

        return $this->database->lastInsertId();
    }

    public function select(string $group, array $data = array(), array $where = array(), array $order = array(), int $limit = -1, int $offset = 0): array
    {
        if (!empty($data)) {
            $sqlSELECT = 'SELECT ' . implode(', ', array_values($data)) . ' FROM ' . $group;
        } else {
            $sqlSELECT = 'SELECT * FROM ' . $group;
        }
        $sqlWHERE = '';
        $sqlORDER = '';
        $sqlLIMIT = '';

        if (!empty($where)) {
            $aWhere = array();

            foreach($where as $key => $value) {
                $aWhere[] = $key . ' ' . $value;
            }

            $sqlWHERE = ' WHERE ' . implode(' AND ', $aWhere);
        }

        if (!empty($order)) {
            $sqlORDER = ' ORDER BY ' . implode(', ', $order);
        }

        if ($limit > -1) {
            if ($offset != 0) {
                $sqlORDER = ' LIMIT ' . $offset . ', ' . $limit;
            } else {
                $sqlORDER = ' LIMIT ' . $limit;
            }
        }

        $sqlFULL = $sqlSELECT.$sqlWHERE.$sqlORDER.$sqlLIMIT;
        $stmt = $this->database->prepare($sqlFULL);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update(string $group, array $data, array $where = array()): int
    {
        $sqlUPDATE = 'UPDATE ' . $group;
        $sqlSET = ' SET name=?, surname=?, sex=?';
        $sqlWHERE = '';

        if (!empty($where)) {
            $aWhere = array();

            foreach($where as $key => $value) {
                $aWhere[] = $key . ' ' . $value;
            }

            $sqlWHERE = ' WHERE ' . implode(' AND ', $aWhere);
        }

        $sqlFULL = $sqlUPDATE.$sqlSET.$sqlWHERE;
        $stmt = $this->database->prepare($sqlFULL);
        return $stmt->execute();
    }

    public function delete(string $group, array $where = array()): int
    {
        $sqlDELETE = 'DELETE FROM ' .$group;
        $sqlWHERE = '';

        if (!empty($where)) {
            $aWhere = array();

            foreach($where as $key => $value) {
                $aWhere[] = $key . ' ' . $value;
            }

            $sqlWHERE = ' WHERE ' . implode(' AND ', $aWhere);
        }

        $sqlFULL = $sqlDELETE.$sqlWHERE;
        $stmt= $this->database->prepare($sqlFULL);
        return $stmt->execute();
    }
}