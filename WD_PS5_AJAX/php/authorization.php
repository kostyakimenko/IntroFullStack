<?php

spl_autoload_register(function($class) {
    include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . $class . '.php';
});
$config = require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

// Create object for database input/output,
// get users table and current username and password
$dbIO = new DatabaseIO($config['users']);
$users = $dbIO->readData();
$username = (isset($_POST['user'])) ? htmlspecialchars($_POST['user']) : null;
$password = (isset($_POST['pass'])) ? htmlspecialchars($_POST['pass']) : null;

// User data handling
$userHandler = new UserHandler($users, $username, $password);
if ($userHandler->isNewUser()) {
    $userHandler->addUser();
    $users = $userHandler->getUsers();
    $dbIO->writeData($users);
}

// Check authorization
$auth = new Authorizer($users, $username, $password);
if ($auth->isAuthOk()) {
    session_start();
    $_SESSION['user'] = $username;
    echo 'auth_ok';
} else {
    echo 'auth_err';
}
