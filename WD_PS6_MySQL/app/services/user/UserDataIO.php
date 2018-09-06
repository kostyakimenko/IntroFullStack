<?php

namespace app\services\user;

use app\services\io\DataIO;
use app\services\io\DBConnector;
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
     * @param DBConnector $conn Object for connection
     */
    public function __construct(DBConnector $conn)
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
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $statement = $this->conn->query($sql);
        $result = $statement->fetch(PDO::FETCH_ASSOC);

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

        $sql = "INSERT INTO users (username, password) VALUES ('$name', '$pass')";
        $this->conn->query($sql);
    }
}
