<?php

namespace app\services\user;

/**
 * Class User.
 * @package user
 */
class User
{
    private $username;
    private $password;

    /**
     * User constructor.
     * @param string $username User name
     * @param string $password User password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Get user name.
     * @return string User name
     */
    public function getName()
    {
        return $this->username;
    }

    /**
     * Get user pass.
     * @return string User pass
     */
    public function getPass()
    {
        return $this->password;
    }
}
