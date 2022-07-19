<?php

use PHPUnit\Framework\TestCase;
use Manuel\Core\Classes\ConnectionFile;
use Manuel\Core\Classes\UserRegistration;

class UserRegistrationTest extends TestCase
{
    public function testUserRegistration(): void
    {
        $connector = new ConnectionFile('fileStorage.inc');
        $userRegistration = new UserRegistration($connector);
        $userRegistration->registerUser('Daniel', 'qwertz');

        $this->assertEquals(array(array('username' => 'Daniel', 'password' => 'qwertz')), $connector->select('users', array(), array('username' => 'Daniel')));
    }
}
