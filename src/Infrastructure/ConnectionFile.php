<?php

namespace Manuel\Infrastructure;

use Manuel\Core\Interfaces\IConnection;
use Manuel\Core\Interfaces\IEntity;
use Manuel\Core\PrimaryKey;
use Manuel\Core\PrimaryKeyStandard;

class ConnectionFile implements IConnection
{
    private $filePath = '';
    private $data = array();

    /**
     * @throws \Exception
     */
    public function __construct($filePath)
    {
        if (file_exists($filePath)) {
            $this->filePath = $filePath;
        } else {
            throw new \Exception('Data file cannot be read');
        }
    }

    public function getAllData()
    {
        $fileContent = $this->readFile();
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
    public function select(string $group, array $where = array(), array $order = array(), int $limit = -1, int $offset = 0): array
    {
        $fileContent = $this->readFile();
        $aReturn = array();
        if (isset($fileContent[$group])) {
            foreach ($fileContent[$group] as $contentValue) {
                $found = true;
                foreach ($where as $whereKey => $whereValue) {
                    $found = ($found and $contentValue->{'get'.ucfirst($whereKey)}() == $whereValue);
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

    public function insert(string $group, IEntity $data): PrimaryKey
    {
        $fileContent = $this->readFile();
        $lastEntryPk = 0;
        if (!empty($fileContent[$group])) {
            $lastEntry = end($fileContent[$group]);
            $lastEntryPk = $lastEntry->getPk()->getId()+1;
        }
        $data->setPK(new PrimaryKeyStandard($lastEntryPk));
        $fileContent[$group][] = $data;
        $this->writeFile($fileContent);
        return new PrimaryKeyStandard(array_search($data, $fileContent[$group]));
    }

    public function update(string $group, array $where = array(), array $data): array
    {
        $fileContent = $this->readFile();
        $changedArray = array();

        foreach ($fileContent[$group] as $contentKey => &$contentValue) {
            $found = true;
            foreach ($where as $whereKey => $whereValue) {
                $found = ($found and $contentValue->{'get'.ucfirst($whereKey)}() == $whereValue);
            }
            if ($found) {
                $changedArray[] = $contentValue;
                foreach ($data as $dataKey => $dataValue) {
                    $contentValue->{'set'.ucfirst($dataKey)}($dataValue);
                }
            }
        }
        $this->writeFile($fileContent);
        return $changedArray;
    }

    public function delete(string $group, array $where = array()): int
    {
        $fileContent = $this->readFile();
        $changedCount = 0;

        foreach ($fileContent[$group] as $contentKey => &$contentValue) {
            $found = true;
            foreach ($where as $whereKey => $whereValue) {
                $found = ($found and $contentValue->{'get'.ucfirst($whereKey)}() == $whereValue);
            }
            if ($found) {
                $changedCount++;
                unset($fileContent[$group][$contentKey]);
            }
        }

        $this->writeFile($fileContent);
        return $changedCount;
    }
}