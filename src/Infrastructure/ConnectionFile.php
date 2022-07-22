<?php

namespace Manuel\Core\Classes;

use Manuel\Core\Interfaces\IConnection;
use Manuel\Core\Interfaces\IEntity;
use Manuel\Core\PrimaryKey;

class ConnectionFile implements IConnection
{
    private $filePath = '';
    private $data = array();

    public function __construct($filePath)
    {
        if (file_exists($filePath)) {
            $this->filePath = $filePath;
        } else {
            throw new \Exception('Data file cannot be read');
        }
    }

    protected function readFile()
    {
        if (empty(file_get_contents($this->filePath))) {
            return array();
        } else {
            return unserialize(file_get_contents($this->filePath));
        }
    }

    protected function writeFile($data)
    {
        file_put_contents($this->filePath, serialize($data));
    }

    /**
     * @throws \Exception
     */
    public function select(string $group, array $data = array(), array $where = array(), array $order = array(), int $limit = -1, int $offset = 0): IEntity
    {
        $fileContent = $this->readFile();
        $aReturn = array();
        if (isset($fileContent[$group])) {
            foreach ($fileContent[$group] as $contentValue) {
                $found = true;
                foreach ($where as $whereKey => $whereValue) {
                    $found = ($found and $contentValue[$whereKey] == $whereValue);
                }
                if ($found) {
                    $aReturn[] = $contentValue;
                }
            }
        } else {
            throw new \Exception('table does not exists');
        }
        return $aReturn;
    }

    public function insert(string $group, array $data): PrimaryKey
    {
        $fileContent = $this->readFile();
        $fileContent[$group][] = $data;
        $this->writeFile($fileContent);
        return array_search($data, $fileContent[$group]);
    }

    public function update(string $group, array $data, array $where = array()): PrimaryKey
    {
        $fileContent = $this->readFile();
        $changedCounter = 0;
        foreach ($fileContent[$group] as $contentKey => &$contentValue) {
            $found = true;
            foreach ($where as $whereKey => $whereValue) {
                $found = ($found and $contentValue[$whereKey] == $whereValue);
            }
            if ($found) {
                $changedCounter++;
                foreach ($data as $dataKey => $dataValue) {
                    $contentValue[$dataKey] = $dataValue;
                }
            }
        }
        $this->writeFile($fileContent);
        return $changedCounter;
    }

    public function delete(string $group, array $where = array()): PrimaryKey
    {
        $fileContent = $this->readFile();
        $changedCounter = 0;
        foreach ($fileContent[$group] as $contentKey => &$contentValue) {
            $found = true;
            foreach ($where as $whereKey => $whereValue) {
                $found = ($found and $contentValue[$whereKey] == $whereValue);
            }
            if ($found) {
                $changedCounter++;
                unset($fileContent[$group][$contentKey]);
            }
        }
        $this->writeFile($fileContent);
        return $changedCounter;
    }
}