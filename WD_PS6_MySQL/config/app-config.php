<?php

define('HANDLERS_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'handlers');
define('TEMPLATES_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'templates');

return [
    'authorization' => HANDLERS_PATH . DIRECTORY_SEPARATOR . 'authorization.php',
    'messaging' => HANDLERS_PATH . DIRECTORY_SEPARATOR . 'messaging.php',
    'header' => TEMPLATES_PATH . DIRECTORY_SEPARATOR . 'header.php',
    'footer' => TEMPLATES_PATH . DIRECTORY_SEPARATOR . 'footer.php',
    'auth-block' => TEMPLATES_PATH . DIRECTORY_SEPARATOR . 'auth-block.php',
    'chat-block' => TEMPLATES_PATH . DIRECTORY_SEPARATOR . 'chat-block.php'
];
