<?php

// Сonnect the class autoloader
require $config['classLoader'];
$classLoader = new ClassLoader();

use io\DBConnector;
use user\UserDataIO;
use user\Authorizer;
use user\User;
use user\UserHandler;

// Connect to the database
try {
    $connect = new DBConnector($config['connect']);
} catch (PDOException $e) {
    session_start();
    $_SESSION['db_err_msg'] = $e->getMessage();
    http_response_code(500);
    exit;
}

// Create objects for user authorization
$dbIO = new UserDataIO($connect);
$auth = new Authorizer($dbIO);

$authAction = (isset($_POST['action'])) ? htmlspecialchars($_POST['action']) : null;

switch ($authAction) {
    case 'login':
        // Get username and password
        $username = (isset($_POST['user'])) ? htmlspecialchars($_POST['user']) : null;
        $password = (isset($_POST['pass'])) ? htmlspecialchars($_POST['pass']) : null;
        $user = new User($username, $password);

        // User handling
        $userHandler = new UserHandler($dbIO);
        if ($userHandler->isNewUser($user)) {
            $userHandler->addUser($user);
        }

        // User authorization
        $authRes = ($auth->login($user)) ? 'auth_ok' : 'auth_error';
        echo $authRes;
        break;

    case 'logout':
        $auth->logout();
}
