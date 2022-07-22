<?php

namespace Manuel\Infrastructure;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Manuel\Core\Interfaces\IEntity;
use Manuel\Core\PrimaryKey;

class ConnectionDoctrine implements \Manuel\Core\Interfaces\IConnection
{
    public EntityManager $entityManager;

    public function __construct()
    {
        // Create a simple "default" Doctrine ORM configuration for Annotations
        $isDevMode = true;
        $proxyDir = null;
        $cache = null;
        $useSimpleAnnotationReader = false;
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
        // or if you prefer yaml or XML
        // $config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
        // $config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

        // database configuration parameters
        $conn = array(
            'driver'    => 'pdo_mysql',
            'host'      => $_ENV['db_host'],
            'user'      => $_ENV['db_user'],
            'password'  => $_ENV['db_pass'],
            'dbname'    => $_ENV['db_name'],
        );

        // obtaining the entity manager
        $this->entityManager = EntityManager::create($conn, $config);
    }

    public function select(string $group, array $data = array(), array $where = array(), array $order = array(), int $limit = -1, int $offset = 0): IEntity
    {
        return $this->entityManager->getRepository($group)->findBy($where);
    }

    public function insert(string $group, array $data): PrimaryKey
    {
        $product = new $group;

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        return $group->getPK();
    }

    public function update(string $group, array $data, array $where = array()): PrimaryKey
    {
        $product = $this->entityManager->find($group, $where['id']);

        if ($product === null) {
            echo 'Product ' . $where['id'] . ' does not exist.'."\n";
            exit(1);
        }

        $product->setName($data['name']);
        $this->entityManager->flush();

        return $group->getPK();
    }

    public function delete(string $group, array $where = array()): PrimaryKey
    {
        $single_user = $this->entityManager->getReference($group, $where['id']);

        $this->entityManager->remove($single_user);
        $this->entityManager->flush();

        return $group->getPK();
    }
}