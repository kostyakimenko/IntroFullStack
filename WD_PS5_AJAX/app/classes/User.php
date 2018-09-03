<?php

/**
 * Class User.
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
    public function getName() {
        return $this->username;
    }

    /**
     * Get user data.
     * @return array User data as associative array
     */
    public function userData() {
        $user = [];
        $user['username'] = $this->username;
        $user['password'] = $this->password;

        return $user;
    }
}
