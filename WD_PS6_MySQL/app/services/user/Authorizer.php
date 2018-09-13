<?php

namespace app\services\user;

use app\services\DataIO;

/**
 * Class Authorizer.
 * User authorization.
 * @package user
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
     * @param User $user
     * @return bool Auth result
     */
    public function login(User $user)
    {
        $username = $user->getName();
        $password = $user->getPass();

        $resp = $this->dataIO->selectData($username);

        if (password_verify($password, $resp['password'])) {
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
