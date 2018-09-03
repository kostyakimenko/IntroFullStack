<?php

// Сonnect the class autoloader
require $config['classLoader'];
$classLoader = new ClassLoader();

// Create object for user authorization
$fileIO = new FileIO($config['users']);
$auth = new Authorizer($fileIO);

$action = (isset($_POST['action'])) ? htmlspecialchars($_POST['action']) : null;

switch ($action) {
    case 'login':
        // Get username and password
        $username = (isset($_POST['user'])) ? htmlspecialchars($_POST['user']) : null;
        $password = (isset($_POST['pass'])) ? htmlspecialchars($_POST['pass']) : null;
        $user = new User($username, $password);

        // User handling
        $userHandler = new UserHandler($fileIO);
        if ($userHandler->isNewUser($user)) {
            $userHandler->addUser($user);
        }

        // User authorization
        $authRes = ($auth->login($user)) ? 'success' : 'error';
        echo $authRes;
        break;

    case 'logout':
        $auth->logout();
}
