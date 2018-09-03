<?php

/**
 * Class Authorizer.
 * User authorization.
 */
class Authorizer
{
    private $dataIO;

    /**
     * Authorizer constructor.
     * @param DataIO $dataIO Object for input and output data
     */
    public function __construct(DataIO $dataIO)
    {
        $this->dataIO = $dataIO;
    }

    /**
     * User log in.
     * @param User $user User object
     * @return bool Auth result
     */
    public function login(User $user)
    {
        $users = $this->dataIO->readData();

        if (in_array($user->userData(), $users)) {
            session_start();
            $_SESSION['user'] = $user->getName();
            return true;
        }

        return false;
    }

    /**
     * User log out.
     */
    public function logout()
    {
        session_start();

        if (isset($_SESSION['user'])) {
            session_destroy();
        }
    }
}
