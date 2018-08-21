<?php

spl_autoload_register(function($class) {
    include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . $class . '.php';
});
$config = require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

try {
    checkDB($config['users']);
    checkDB($config['messages']);
    echo 'valid';
} catch (Exception $ex) {
    echo 'error';
}

/**
 * @param $dbPath
 * @throws Exception
 */
function checkDB($dbPath)
{
    $dbIO = new DatabaseIO($dbPath);
    $validator = new DBValidator($dbPath, $dbIO);

    if (!$validator->isFileValid() || !$validator->isContentValid()) {
        throw new Exception();
    }
}
