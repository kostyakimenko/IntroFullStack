<?php

$config = require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

$route = (isset($_POST['route'])) ? htmlspecialchars($_POST['route']) : null;

// Select of the handler depending on the request
switch ($route) {
    case 'check_database':
        require $config['validation'];
        break;
    case 'auth':
        require $config['authorization'];
        break;
    case 'messaging':
        require $config['messaging'];
        break;
}
