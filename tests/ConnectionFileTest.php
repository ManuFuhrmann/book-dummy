<?php

use Manuel\Core\Interfaces\IConnection;
use Manuel\Core\PrimaryKeyStandard;
use Manuel\Domain\EntityUser;
use Manuel\Infrastructure\ConnectionFile;
use PHPUnit\Framework\TestCase;

class ConnectionFileTest extends TestCase
{
    private static $filePath = 'fileStorage.inc';
    private IConnection $connection;

    public static function setUpBeforeClass(): void
    {
        file_put_contents(self::$filePath, "");
    }

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        //call before every test function
        $this->connection = new ConnectionFile(self::$filePath);
    }

    public function testSelectData(): void
    {
        $this->expectErrorMessage('table does not exists');
        $this->assertEquals(array(), $this->connection->select('users', array(), array(array('username' => 'Anton'))));
    }

    public function testInsertData(): void
    {
        $data = new EntityUser(array(
            'username' => 'Anton',
            'password' => 'asdf',
        ));
        $this->assertEquals(new PrimaryKeyStandard(0), $this->connection->insert('users', $data));

        $data = new EntityUser(array(
            'username' => 'Bernd',
            'password' => 'yxcv',
        ));
        $this->assertEquals(new PrimaryKeyStandard(1), $this->connection->insert('users', $data));
    }

    public function testSelectSuccess(): void
    {
        $data = new EntityUser(array(
            'primKey' => new PrimaryKeyStandard(0),
            'username' => 'Anton',
            'password' => 'asdf',
        ));

        $this->assertEquals(array($data), $this->connection->select('users', array('username' => 'Anton')));
    }

    public function testSelectFailed(): void
    {
        $this->assertEquals(array(), $this->connection->select('users', array('username' => 'Charles')));
    }

    public function testUpdateDataSuccess(): void
    {
        $data = new EntityUser(array(
            'primKey' => new PrimaryKeyStandard(1),
            'username' => 'Bernd',
            'password' => 'xkcd',
        ));

        $this->assertEquals(array($data), $this->connection->update('users', array('username' => 'Bernd'), array('password' => 'xkcd')));
    }

    public function testUpdateDataFailed(): void
    {
        $this->assertEquals(array(), $this->connection->update('users', array('username' => 'Charles'), array('password' => 'xkcd')));
    }

    public function testDeleteSuccess(): void
    {
        $data = new EntityUser(array(
            'primKey' => new PrimaryKeyStandard(0),
            'username' => 'Anton',
            'password' => 'asdf',
        ));

        $this->assertEquals(1, $this->connection->delete('users', array('username' => 'Anton')));
    }
}
