<?php
session_start();

$config = require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

// Сonnect the class autoloader
require $config['classLoader'];
$classLoader = new ClassLoader();

// Files validation
$usersValidator = new FileValidator(new FileIO($config['users']));
$messagesValidator = new FileValidator(new FileIO($config['messages']));
$_SESSION['db_valid'] = $usersValidator->isFileValid() && $messagesValidator->isFileValid();

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
