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
     * @param string $username User name
     * @param string $password User password
     * @return bool Auth result
     */
    public function login($username, $password)
    {
        $users = $this->dataIO->readData();

        if ($users[$username] === $password) {
            session_start();
            $_SESSION['user'] = $username;
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
