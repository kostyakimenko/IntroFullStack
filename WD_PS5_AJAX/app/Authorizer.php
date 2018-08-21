<?php

class Authorizer
{
    private $users;
    private $username;
    private $password;

    public function __construct($users, $username, $password)
    {
        $this->users = $users;
        $this->username = $username;
        $this->password = $password;
    }

    public function isAuthOk()
    {
        return $this->users[$this->username] === $this->password;
    }
}
