<?php

// Сonnect the class autoloader
require $config['classLoader'];
$classLoader = new ClassLoader();

use io\DBConnector;
use message\Message;
use message\MessageDataIO;
use message\Messenger;

// Check authorization of the user
session_start();
$user = $_SESSION['user'] ?? null;

if ($user === null) {
    http_response_code(401);
    exit;
}

// Connect to the database
try {
    $connect = new DBConnector($config['connect']);
} catch (PDOException $e) {
    session_start();
    $_SESSION['db_err_msg'] = $e->getMessage();
    http_response_code(500);
    exit;
}

// Create objects for messaging
$dbIO = new MessageDataIO($connect);
$messenger = new Messenger($dbIO);

// Request data
$msg = (isset($_POST['msg'])) ? htmlspecialchars($_POST['msg']) : null;
$action = (isset($_POST['action'])) ? htmlspecialchars($_POST['action']) : null;
$msgId = (isset($_POST['msgId'])) ? htmlspecialchars($_POST['msgId']) : 0;

// Select action for messaging
switch ($action) {
    case 'addMsg':
        $message = new Message($user, $msg);
        $messenger->addMsg($message);
        header('Content-type: application/json');
        echo json_encode($messenger->getMsg($msgId));
        break;
    case 'getAllMsg':
        header('Content-type: application/json');
        echo json_encode($messenger->getMsg());
        break;
    case 'update':
        $msgTable = [];
        if ($dbIO->isUpdatedTable($msgId)){
            $msgTable = $messenger->getMsg($msgId);
        }
        header('Content-type: application/json');
        echo json_encode($msgTable);
        break;
}
