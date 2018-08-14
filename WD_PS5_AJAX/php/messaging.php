<?php

$config = require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

require $config['messenger'];

$username = (isset($_POST['user'])) ? htmlspecialchars($_POST['user']) : null;
$message = (isset($_POST['msg'])) ? htmlspecialchars($_POST['msg']) : null;
$requestType = (isset($_POST['type'])) ? htmlspecialchars($_POST['type']) : null;

switch ($requestType) {
    case 'addMsg':
        $messenger = new Messenger($config['messages']);
        $messenger->addMsg($username, $message);
        break;
    case 'getMsg':
        $messenger = new Messenger($config['messages']);
        $response = [];
        $response['msgTable'] = $messenger->getLastHoursMsg();
        $response['updateTime'] = filemtime($config['messages']);
        echo json_encode($response);
        break;
    case 'updTime':
        echo filemtime($config['messages']);
        break;
}
