<?php

class Authorizer
{
    private $path;
    private $users;
    private $username;
    private $password;

    public function __construct($path, $username, $password)
    {
        $this->path = $path;
        $this->users = $this->getUsers();
        $this->username = $username;
        $this->password = $password;
    }

    private function getUsers()
    {
        return json_decode(file_get_contents($this->path), true);
    }

    public function isNewUser()
    {
        return !array_key_exists($this->username, $this->users);
    }

    public function isValidPassword()
    {
        return $this->users[$this->username] === $this->password;
    }

    public function addUser()
    {
        $this->users[$this->username] = $this->password;
        file_put_contents($this->path, json_encode($this->users, JSON_PRETTY_PRINT));
    }
}