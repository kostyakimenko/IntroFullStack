<?php

$config = require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

require $config['connector'];
require $config['databaseIO'];
require $config['databaseChecker'];

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
    $dbIO = new DatabaseIO($filePath);
    $dbChecker = new DatabaseChecker($filePath, $dbIO);

    if (!$dbChecker->isFileValid() || !$dbChecker->isContentValid()) {
        throw new Exception();
    }
}