<?php

$config = require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

require $config['connector'];

try {
    connectFile($config['users']);
    connectFile($config['messages']);
    echo 'success';
} catch (Exception $ex) {
    echo 'error';
}

/**
 * @param $filePath
 * @throws Exception
 */
function connectFile($filePath)
{
    $connector = new DBConnector($filePath);

    if (!$connector->isFileExists() && $connector->isDirValid()) {
        $connector->createEmptyFile();
    } elseif (!$connector->isFileValid()) {
        throw new Exception();
    }
}