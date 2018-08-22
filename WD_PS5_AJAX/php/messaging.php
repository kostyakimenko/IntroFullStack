<?php

spl_autoload_register(function($class) {
    include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . $class . '.php';
});
$config = require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

session_start();

// Session data
$username = (isset($_SESSION['user'])) ? htmlspecialchars($_SESSION['user']) : null;
$updateTime = (isset($_SESSION['updTime'])) ? htmlspecialchars($_SESSION['updTime']) : 0;

// Request data
$message = (isset($_POST['msg'])) ? htmlspecialchars($_POST['msg']) : null;
$action = (isset($_POST['action'])) ? htmlspecialchars($_POST['action']) : null;

// Create objects for DB input/output and messaging
$dbIO = new DatabaseIO($config['messages']);
$messenger = new Messenger($dbIO);

// Select action for messaging
switch ($action) {
    case 'addMsg':
        $messenger->addMsg($username, $message);
        echo json_encode($messenger->getMsg($updateTime));
        break;
    case 'getAllMsg':
        echo json_encode($messenger->getMsg());
        break;
    case 'update':
        $lastUpdateTime = $messenger->msgUpdateTime();
        if ($updateTime !== $lastUpdateTime){
            echo json_encode($messenger->getMsg($updateTime));
        }
        break;
}

$_SESSION['updTime'] = $messenger->msgUpdateTime();
