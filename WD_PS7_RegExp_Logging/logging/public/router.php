<?php

define('CONFIG_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR);
define('PROJECT_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);

// Configuration data
$config = require CONFIG_PATH . 'app-config.php';
$database = require CONFIG_PATH . 'db-config.php';

// Class autoloader
spl_autoload_register(function($class) {
    require PROJECT_PATH . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
});
// Objects for logging and server response
$response = new \app\services\Response();
$logger = new app\services\Logger($config['logs']);

// Connect to the database
$dsn = "mysql:dbname={$database['dbname']};host={$database['hostname']}";
$user = $database['username'];
$pass = $database['password'];
$options = [PDO::ATTR_PERSISTENT => true];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    $response->setResponseData('db_error', 'Database connect error');
    $response->sendResponse();
    $logger->logging('db connecting', $response);
    exit;
}

// Select of the handler depending on the request
$route = $_POST['route'] ?? null;

switch ($route) {
    case 'auth':
        require $config['authorization'];
        break;
    case 'messaging':
        require $config['messaging'];
        break;
}
