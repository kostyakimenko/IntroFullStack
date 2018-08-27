<?php

$config = require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

// Сonnect the class autoloader
require $config['classLoader'];
$classLoader = new ClassLoader();

// Create object for user authorization
$dbIO = new JsonIO($config['users']);
$auth = new Authorizer($dbIO);

$authAction = (isset($_POST['auth_action'])) ? htmlspecialchars($_POST['auth_action']) : null;

switch ($authAction) {
    case 'login':
        // Get username and password
        $username = (isset($_POST['user'])) ? htmlspecialchars($_POST['user']) : null;
        $password = (isset($_POST['pass'])) ? htmlspecialchars($_POST['pass']) : null;

        // User handling
        $userHandler = new UserHandler($dbIO);
        if ($userHandler->isNewUser($username)) {
            $userHandler->addUser($username, $password);
        }

        // User authorization
        $authRes = ($auth->login($username, $password)) ? 'success' : 'error';
        echo $authRes;
        break;

    case 'logout':
        $auth->logout();
}
