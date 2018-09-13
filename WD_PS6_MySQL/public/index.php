<?php

session_start();

$config = require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'app-config.php';

// Including html blocks
require $config['header'];

if (isset($_SESSION['user'])) {
    require $config['chat-block'];
    $_SESSION['hello_msg'] = true;
} else {
    require $config['auth-block'];
}

require $config['footer'];
