<?php

$config = require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

// Сonnect the class autoloader
require $config['classLoader'];
$classLoader = new ClassLoader();

// Database files validation
try {
    checkJson($config['users']);
    checkJson($config['messages']);
    echo 'success';
} catch (Exception $ex) {
    echo 'error';
}

/**
 * Check file.
 * @param string $jsonPath Path to the database file
 * @throws Exception Invalid file
 */
function checkJson($jsonPath)
{
    $jsonIO = new JsonIO($jsonPath);
    $validator = new JsonValidator($jsonPath, $jsonIO);

    if (!$validator->isFileValid() || !$validator->isContentValid()) {
        throw new Exception();
    }
}
