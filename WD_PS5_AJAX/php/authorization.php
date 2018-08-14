<?php

$config = require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

require $config['authorizer'];

$username = (isset($_POST['user'])) ? htmlspecialchars($_POST['user']) : null;
$password = (isset($_POST['pass'])) ? htmlspecialchars($_POST['pass']) : null;

$auth = new Authorizer($config['users'], $username, $password);

if (empty($username)) {
    echo 'user error';
} elseif ($auth->isNewUser()) {
    $auth->addUser();
    echo 'success';
} elseif ($auth->isValidPassword()) {
    echo 'success';
} else {
    echo 'pass error';
}