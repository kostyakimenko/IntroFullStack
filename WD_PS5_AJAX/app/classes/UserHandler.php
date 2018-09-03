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
     * @param User $user User data
     * @return bool Checking result
     */
    public function isNewUser(User $user)
    {
        $names = array_column($this->users, 'username');
        return !in_array($user->getName(), $names);
    }

    /**
     * Add user to table.
     * @param User $user User data
     */
    public function addUser(User $user)
    {
        array_push($this->users, $user->userData());
        $this->dataIO->writeData($this->users);
    }
}
