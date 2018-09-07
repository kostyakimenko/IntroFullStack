<?php

// Сonnect the class autoloader
require $config['classLoader'];
$classLoader = new ClassLoader();

session_start();

// Check user authorization
if (!isset($_SESSION['user'])) {
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
        $messenger->addMessage($_SESSION['user'], $message);
        header('Content-type: application/json');
        echo json_encode($messenger->getMessages($updateTime));
        break;
    case 'getAllMsg':
        header('Content-type: application/json');
        echo json_encode($messenger->getMessages());
        break;
    case 'update':
        $msgTable = [];
        if ($updateTime != $messenger->lastMsgTime()){
            $msgTable = $messenger->getMessages($updateTime);
        }
        header('Content-type: application/json');
        echo json_encode($msgTable);
        break;
}
