<?php

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'SpeechBalloonsHandler.php';
$filePath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'json' . DIRECTORY_SEPARATOR . 'speech-balloons_info.json';

// Object for handling speech balloons info
$handler = new SpeechBalloonsHandler($filePath);

// Handling post-request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $speechBalloons = json_decode($handler->readInfo(), true);
    $id = $_POST['id'];

    foreach ($_POST as $key => $value) {
        if ($key !== 'id') {
            $speechBalloons[$id][$key] = $value;
        }
    }

    if (empty($speechBalloons[$id]['text'])) {
        unset($speechBalloons[$id]);
        echo('remove');
    }

    $handler->writeInfo($speechBalloons);
    exit;
}

// Handling get-request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Content-type: json/application');
    echo ($handler->readInfo());
}
