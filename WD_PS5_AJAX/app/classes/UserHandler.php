<?php

/**
 * Class UserHandler.
 * User data handling.
 */
class UserHandler
{
    private $dataIO;
    private $users;

    /**
     * UserHandler constructor.
     * @param DataIO $dataIO Objects for input and output data
     */
    public function __construct(DataIO $dataIO)
    {
        $this->dataIO = $dataIO;
        $this->users = $dataIO->readData();
    }

    /**
     * Check is new user.
     * @param string $username User name
     * @return bool Checking result
     */
    public function isNewUser($username)
    {
        return !array_key_exists($username, $this->users);
    }

    /**
     * Add user to table.
     * @param string $username User name
     * @param string $password User password
     */
    public function addUser($username, $password)
    {
        $this->users[$username] = $password;
        $this->dataIO->writeData($this->users);
    }
}
