<?php

session_start();

use app\services\message\{Message, MessageDataIO, Messenger};

// Check user authorization
$user = $_SESSION['user'] ?? false;

if (!$user) {
    $response->setResponseData('user_error', 'Unauthorized');
    $response->sendResponse();
    $logger->logging('messaging', $response);
    exit;
}

// Check message
$msg = $_POST['msg'] ?? null;

if ($msg !== null && empty(trim($msg))) {
    $response->setResponseData('msg_error', 'Empty message');
    $response->sendResponse();
    $logger->logging('messaging', $response);
    exit;
}

if (strlen($msg) > 255) {
    $response->setResponseData('msg_error', 'Too large message (max length 255)');
    $response->sendResponse();
    $logger->logging('messaging', $response);
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
        $response->setResponseData('success', 'User send message', $messenger->getMessages($lastMsgId));
        $response->sendResponse();
        $logger->logging('messaging', $response);
        exit;
    case 'getAllMsg':
        $response->setResponseData('success', 'Uploading message history', $messenger->getMessages());
        $response->sendResponse();
        $logger->logging('messaging', $response);
        exit;
    case 'update':
        $msgTable = [];

        if ($dbIO->isUpdatedTable($lastMsgId)){
            $msgTable = $messenger->getMessages($lastMsgId);
        }

        $response->setResponseData('success', 'Updated message list', $msgTable);
        $response->sendResponse();

        if (!empty($msgTable)) {
            $logger->logging('messaging', $response);
        }

        exit;
}
