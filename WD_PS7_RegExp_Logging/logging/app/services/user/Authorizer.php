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

        $userData = $this->dataIO->selectData($username);

        if (password_verify($password, $userData['password'])) {
            session_start();
            $_SESSION['user'] = $username;
            $_SESSION['user_id'] = $userData['id'];
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
