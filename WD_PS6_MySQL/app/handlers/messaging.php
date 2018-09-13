<?php

session_start();

use app\services\message\{Message, MessageDataIO, Messenger};

// Check user authorization
$user = $_SESSION['user'] ?? false;

if (!$user) {
    $response->responseData('user_error', 'Unauthorized');
    $response->sendResponse();
    exit;
}

// Check message
$msg = $_POST['msg'] ?? null;

if ($msg !== null && empty(trim($msg))) {
    $response->responseData('msg_error', 'Empty message');
    $response->sendResponse();
    exit;
}

if (strlen($msg) > 255) {
    $response->responseData('msg_error', 'Too large message (max length 255)');
    $response->sendResponse();
    exit;
}

// Create objects for messaging
$dbIO = new MessageDataIO($pdo);
$messenger = new Messenger($dbIO);

// Request data
$action = $_POST['action'] ?? null;
$lastMsgId = $_POST['last_id'] ?? 0;

// Select action for messaging
switch ($action) {
    case 'addMsg':
        $message = new Message($user, htmlspecialchars($msg));
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
