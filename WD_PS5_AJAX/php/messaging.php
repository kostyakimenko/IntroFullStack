<?php

spl_autoload_register(function($class) {
    include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . $class . '.php';
});
$config = require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

session_start();

// Session data
$username = $_SESSION['user'] ?? null;
$databaseSize = $_SESSION['dbSize'] ?? null;
$updateTime = $_SESSION['updTime'] ?? 0;

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
        echo json_encode($messenger->getNewMsg($updateTime));
        setUpdateData($messenger->lastMsgTime(), $dbIO->databaseSize());
        break;
    case 'getAllMsg':
        echo json_encode($messenger->getNewMsg());
        setUpdateData($messenger->lastMsgTime(), $dbIO->databaseSize());
        break;
    case 'update':
        $newSize = $dbIO->databaseSize();
        if ($newSize != $databaseSize){
            echo json_encode($messenger->getNewMsg($updateTime));
            setUpdateData($messenger->lastMsgTime(), $newSize);
        }
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
