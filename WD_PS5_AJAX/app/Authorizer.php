<?php

/**
 * Class Authorizer.
 * User authorization.
 */
class Authorizer
{
    private $users;
    private $username;
    private $password;

    /**
     * Authorizer constructor.
     * @param array $users Table with users data (user => password)
     * @param string $username User name
     * @param string $password User password
     */
    public function __construct($users, $username, $password)
    {
        $this->users = $users;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Authorization result.
     * @return bool Check user result
     */
    public function isAuthOk()
    {
        return $this->users[$this->username] === $this->password;
    }
}
