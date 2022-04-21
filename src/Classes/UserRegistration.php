<?php

namespace Manuel\Core\Classes;

class UserRegistration extends DataObject
{
    public function registerUser(
        string $username,
        string $plainTextPassword
    ): void {
        $this->connection->insert(
            'users',
            array(
                'username' => $username,
                'password' => $plainTextPassword
            )
        );
    }
}