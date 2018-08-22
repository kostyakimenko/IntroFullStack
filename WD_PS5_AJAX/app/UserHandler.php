<?php

/**
 * Class UserHandler.
 * User data handling.
 */
class UserHandler
{
    private $users;
    private $username;
    private $password;

    /**
     * UserHandler constructor.
     * @param array $users Users table
     * @param string $username User name
     * @param string $password User password
     * @throws Exception Username or password is empty
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

    /**
     * Check is new user.
     * @return bool checking result
     */
    public function isNewUser()
    {
        return !array_key_exists($this->username, $this->users);
    }

    /**
     * Get users table.
     * @return array Users table
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add user to table.
     */
    public function addUser()
    {
        $this->users[$this->username] = $this->password;
    }
}
