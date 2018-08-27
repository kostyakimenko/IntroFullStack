<?php

$config = require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

// Сonnect the class autoloader
require $config['classLoader'];
$classLoader = new ClassLoader();

// Session data
session_start();
$username = $_SESSION['user'] ?? null;
$databaseSize = $_SESSION['dbSize'] ?? null;
$updateTime = $_SESSION['updTime'] ?? 0;

// Request data
$message = (isset($_POST['msg'])) ? htmlspecialchars($_POST['msg']) : null;
$action = (isset($_POST['action'])) ? htmlspecialchars($_POST['action']) : null;

// Create object for messaging
$dbIO = new JsonIO($config['messages']);
$messenger = new Messenger($dbIO);

// Select action for messaging
switch ($action) {
    case 'addMsg':
        $messenger->addMsg($username, $message);
        echo json_encode($messenger->getNewMsg($updateTime));
        setUpdateData($messenger->lastMsgTime(), $dbIO->databaseSize());
        break;
    case 'getAllMsg':
        echo json_encode($messenger->getNewMsg());
        setUpdateData($messenger->lastMsgTime(), $dbIO->databaseSize());
        break;
    case 'update':
        $msgTable = [];
        $newSize = $dbIO->databaseSize();
        if ($newSize != $databaseSize){
            $msgTable = $messenger->getNewMsg($updateTime);
            setUpdateData($messenger->lastMsgTime(), $newSize);
        }
        echo json_encode($msgTable);
        break;
}

/**
 * Set data of last update
 * @param int $updTime Last message time
 * @param int $dbSize Database size
 */
function setUpdateData($updTime, $dbSize) {
    $_SESSION['updTime'] = $updTime;
    $_SESSION['dbSize'] = $dbSize;
}
