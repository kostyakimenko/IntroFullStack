<?php

session_start();

use app\services\message\{Message, MessageDataIO, Messenger};

// Check user authorization
if (!isset($_SESSION['user'])) {
    $response->responseData('user_error', 'Unauthorized');
    $response->sendResponse();
    exit;
}

// Check message
$message = (isset($_POST['msg'])) ? htmlspecialchars($_POST['msg']) : null;

if ($message !== null && empty(trim($message))) {
    $response->responseData('msg_error', 'Empty message');
    $response->sendResponse();
    exit;
}

if (strlen($message) > 255) {
    $response->responseData('msg_error', 'Too large message (max length 255)');
    $response->sendResponse();
    exit;
}

// Create objects for messaging
$dbIO = new MessageDataIO($pdo);
$messenger = new Messenger($dbIO);

// Request data
$action = (isset($_POST['action'])) ? htmlspecialchars($_POST['action']) : null;
$lastMsgId = (isset($_POST['last_id'])) ? htmlspecialchars($_POST['last_id']) : 0;

// Select action for messaging
switch ($action) {
    case 'addMsg':
        $message = new Message($_SESSION['user'], $message);
        $messenger->addMessage($message);
        $response->responseData('success', '', $messenger->getMessages($lastMsgId));
        $response->sendResponse();
        exit;
    case 'getAllMsg':
        $response->responseData('success', '', $messenger->getMessages());
        $response->sendResponse();
        exit;
    case 'update':
        $msgTable = [];
        if ($dbIO->isUpdatedTable($lastMsgId)){
            $msgTable = $messenger->getMessages($lastMsgId);
        }
        $response->responseData('success', '', $msgTable);
        $response->sendResponse();
        exit;
}
