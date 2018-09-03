<?php

define ('DB_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'database');
define ('HANDLERS_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'handlers');
define ('SERVICES_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'services' );
define ('TEMPLATES_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'templates');

return [
    'users' => DB_PATH . DIRECTORY_SEPARATOR . 'users.json',
    'messages' => DB_PATH . DIRECTORY_SEPARATOR . 'messages.json',
    'authorization' => HANDLERS_PATH . DIRECTORY_SEPARATOR . 'authorization.php',
    'messaging' => HANDLERS_PATH . DIRECTORY_SEPARATOR . 'messaging.php',
    'classLoader' => SERVICES_PATH . DIRECTORY_SEPARATOR . 'ClassLoader.php',
    'header' => TEMPLATES_PATH . DIRECTORY_SEPARATOR . 'header.php',
    'footer' => TEMPLATES_PATH . DIRECTORY_SEPARATOR . 'footer.php',
    'auth-block' => TEMPLATES_PATH . DIRECTORY_SEPARATOR . 'auth-block.php',
    'chat-block' => TEMPLATES_PATH . DIRECTORY_SEPARATOR . 'chat-block.php',
    'db-error' => TEMPLATES_PATH . DIRECTORY_SEPARATOR . 'db-error.php'
];
