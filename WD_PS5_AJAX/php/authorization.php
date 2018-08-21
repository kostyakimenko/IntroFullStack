<?php

spl_autoload_register(function($class) {
    include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . $class . '.php';
});
$config = require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

$dbIO = new DatabaseIO($config['users']);

$users = $dbIO->readData();
$username = (isset($_POST['user'])) ? htmlspecialchars($_POST['user']) : null;
$password = (isset($_POST['pass'])) ? htmlspecialchars($_POST['pass']) : null;

try {
    $userHandler = new UserHandler($users, $username, $password);
    if ($userHandler->isNewUser()) {
        $userHandler->addUser();
        $dbIO->writeData($userHandler->getUsers());
    }

    $auth = new Authorizer($users, $username, $password);
    if ($auth->isAuthOk()) {
        session_start();
        $_SESSION['user'] = $username;
        echo 'auth_ok';
    } else {
        echo 'pass_err';
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}
