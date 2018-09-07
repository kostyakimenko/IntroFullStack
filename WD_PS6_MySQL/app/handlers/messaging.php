<?php

// Including class autoloader
require $config['classLoader'];

use app\services\io\DBConnector;
use app\services\message\{Message, MessageDataIO, Messenger};

session_start();

// Check authorization of the user
if (!isset($_SESSION['user'])) {
    http_response_code(401);
    exit;
}

// Connect to the database
try {
    $connect = new DBConnector($config['database']);
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
$lastMsgId = (isset($_POST['last_id'])) ? htmlspecialchars($_POST['last_id']) : 0;

// Select action for messaging
switch ($action) {
    case 'addMsg':
        $message = new Message($_SESSION['user'], $msg);
        $messenger->addMessage($message);
        header('Content-type: application/json');
        echo json_encode($messenger->getMessages($lastMsgId));
        break;
    case 'getAllMsg':
        header('Content-type: application/json');
        echo json_encode($messenger->getMessages());
        break;
    case 'update':
        $msgTable = [];
        if ($dbIO->isUpdatedTable($lastMsgId)){
            $msgTable = $messenger->getMessages($lastMsgId);
        }
        header('Content-type: application/json');
        echo json_encode($msgTable);
        break;
}
