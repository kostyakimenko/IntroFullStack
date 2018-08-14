<?php

$config = require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

$route = (isset($_POST['route'])) ? htmlspecialchars($_POST['route']) : null;

switch ($route) {
    case 'connect':
        require $config['connect'];
        break;
    case 'authorization':
        require $config['authorization'];
        break;
    case 'messaging':
        require $config['messaging'];
        break;
}
