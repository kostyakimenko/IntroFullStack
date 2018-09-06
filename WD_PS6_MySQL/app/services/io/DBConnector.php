<?php

namespace app\services\io;

use PDO;

/**
 * Class DBConnector.
 * Create connect to the database
 * @package io
 */
class DBConnector extends PDO
{
    /**
     * DBConnector constructor.
     * @param array $connectData Data for connecting
     */
    public function __construct($connectData)
    {
        $dns = "mysql:dbname={$connectData['dbname']};host={$connectData['hostname']}";
        $user = $connectData['username'];
        $pass = $connectData['password'];

        parent::__construct($dns, $user, $pass);
    }
}
