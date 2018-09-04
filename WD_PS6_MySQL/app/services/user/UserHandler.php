<?php

namespace user;

use io\DataIO;

/**
 * Class UserHandler.
 * User data handling.
 * @package user
 */
class UserHandler
{
    private $dataIO;

    /**
     * UserHandler constructor.
     * @param DataIO $dataIO Objects for input and output data
     */
    public function __construct(DataIO $dataIO)
    {
        $this->dataIO = $dataIO;
    }

    /**
     * Check is new user.
     * @param User $user
     * @return bool Checking result
     */
    public function isNewUser(User $user)
    {
        $user = $this->dataIO->selectData($user->getName());

        return !$user;
    }

    /**
     * Add user to database table.
     * @param User $user
     */
    public function addUser(User $user)
    {
        $this->dataIO->insertData($user);
    }
}
