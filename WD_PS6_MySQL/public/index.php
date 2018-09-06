<?php
session_start();

$config = require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

// Including class autoloader
require $config['classLoader'];

use app\services\io\DBConnector;

// Check connecting of the database
try {
    $connect = new DBConnector($config['database']);
    $_SESSION['db_valid'] = true;
} catch (PDOException $e) {
    $_SESSION['db_valid'] = false;
    $_SESSION['db_err_msg'] = $e->getMessage();
}

// Including html blocks
require $config['header'];

if (!$_SESSION['db_valid']) {
    require $config['db-error'];
} elseif (isset($_SESSION['user'])) {
    require $config['chat-block'];
    $_SESSION['hello_msg'] = true;
} else {
    require $config['auth-block'];
}

require $config['footer'];
