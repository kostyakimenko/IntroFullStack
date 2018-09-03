<?php

// Сonnect the class autoloader
require $config['classLoader'];
$classLoader = new ClassLoader();

// Session data
session_start();
$username = $_SESSION['user'] ?? null;

if (is_null($username)) {
    http_response_code(401);
    exit;
}

// Create object for messaging
$fileIO = new FileIO($config['messages']);
try {
    $messenger = new Messenger($fileIO);
} catch (Exception $e) {
    http_response_code(500);
    exit;
}

// Request data
$message = (isset($_POST['msg'])) ? htmlspecialchars($_POST['msg']) : null;
$action = (isset($_POST['action'])) ? htmlspecialchars($_POST['action']) : null;
$updateTime = (isset($_POST['updTime'])) ? htmlspecialchars($_POST['updTime']) : 0;

// Select action for messaging
switch ($action) {
    case 'addMsg':
        $messenger->addMsg($username, $message);
        header('Content-type: application/json');
        echo json_encode($messenger->getMsg($updateTime));
        break;
    case 'getAllMsg':
        header('Content-type: application/json');
        echo json_encode($messenger->getMsg());
        break;
    case 'update':
        $msgTable = [];
        if ($updateTime != $messenger->lastMsgTime()){
            $msgTable = $messenger->getMsg($updateTime);
        }
        header('Content-type: application/json');
        echo json_encode($msgTable);
        break;
}
