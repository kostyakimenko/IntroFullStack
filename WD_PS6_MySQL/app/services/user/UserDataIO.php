<?php

namespace app\services\user;

use app\services\DataIO;
use PDO;

/**
 * Class UserDataIO.
 * @package user
 */
class UserDataIO implements DataIO
{
    private $conn;

    /**
     * UserDataIO constructor.
     * @param PDO $conn Object for connection
     */
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    /**
     * Select data.
     * @param string $username User name
     * @return array User data
     */
    public function selectData($username)
    {
        $sql = 'SELECT * FROM users WHERE username = :username';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['username' => $username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;

        return $result;
    }

    /**
     * Insert data.
     * @param User $user User object
     */
    public function insertData($user)
    {
        $name = $user->getName();
        $pass = password_hash($user->getPass(), PASSWORD_DEFAULT);

        $sql = 'INSERT INTO users (username, password) VALUES (:name, :pass)';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'pass' => $pass]);
        $stmt = null;
    }
}
