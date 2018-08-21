<?php

class UserHandler
{
    private $users;
    private $username;
    private $password;

    /**
     * UserHandler constructor.
     * @param $users
     * @param $username
     * @param $password
     * @throws Exception
     */
    public function __construct($users, $username, $password)
    {
        $this->users = $users;

        if (empty($username)) {
            throw new Exception('empty_login');
        } else {
            $this->username = $username;
        }

        if (empty($password)) {
            throw new Exception('empty_pass');
        } else {
            $this->password = $password;
        }
    }

    public function isNewUser()
    {
        return !array_key_exists($this->username, $this->users);
    }

    public function getUsers()
    {
        return $this->users;
    }

    public function addUser()
    {
        $this->users[$this->username] = $this->password;
    }
}
