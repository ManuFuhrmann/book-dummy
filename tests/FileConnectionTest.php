<?php

use PHPUnit\Framework\TestCase;
use Manuel\Core\Classes\FileConnection;

class FileConnectionTest extends TestCase
{
    private static $filePath = 'fileStorage.inc';
    private $connection;

    public static function setUpBeforeClass(): void
    {
        file_put_contents(self::$filePath, "");
    }

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->connection = new FileConnection(self::$filePath);
        //call before every test function
    }

    public function testSelectData(): void
    {
        $this->expectErrorMessage('table does not exists');
        $this->assertEquals(array(), $this->connection->select('users', array(), array(array('username' => 'Anton'))));
    }

    public function testInsertData(): void
    {
        $data = array(
            'username' => 'Anton',
            'password' => 'asdf',
        );
        $this->connection->insert('users', $data);

        $this->assertEquals(array($data), $this->connection->select('users', array(), array('username' => 'Anton')));
    }

    public function testUpdateData(): void
    {
        $data = array(
            'username' => 'Anton',
            'password' => 'asdf',
        );

        $this->assertEquals(array($data), $this->connection->select('users', array(), array('username' => 'Anton')));

        $this->assertEquals(0, $this->connection->update('users', array('password' => 'yxcv'), array('username' => 'Bernd')));

        $this->assertEquals(1, $this->connection->update('users', array('password' => 'yxcv'), array('username' => 'Anton')));

        $data = array(
            'username' => 'Anton',
            'password' => 'yxcv',
        );
        $this->assertEquals(array($data), $this->connection->select('users', array(), array('username' => 'Anton')));
    }

    public function testDeleteData(): void
    {
        $data = array(
            'username' => 'Bernd',
            'password' => 'qwert',
        );
        $this->connection->insert('users', $data);
        $data = array(
            'username' => 'Claus',
            'password' => 'qwert',
        );
        $this->connection->insert('users', $data);
        $this->assertEquals(2, $this->connection->delete('users', array('password' => 'qwert')));
        $this->assertEquals(1, $this->connection->delete('users', array('username' => 'Anton')));
    }
}
