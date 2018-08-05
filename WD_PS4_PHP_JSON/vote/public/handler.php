<?php

// Include the configuration file
$config = require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
                  . 'config' . DIRECTORY_SEPARATOR . 'config.php';

// Include the classes (JsonChecker and JsonWriter)
require $config['checker'];
require $config['writer'];

session_start();

/*
 * Check json and read table.
 * If json valid get current table,
 * else get default table.
 */
$checker = new JsonChecker($config['json']);

if ($checker->isValidFile()) {
    $table = $checker->getTable();
    $newFile = false;
} else {
    $table = $config['defaultTable'];
    $newFile = true;
}

/*
 * Change vote and write table.
 * If the write was successful send data to chart page,
 * else return error to main page.
 */
try {
    $writer = new JsonWriter($table, $config['json'], $newFile);
    $writer->writeTable();
    header('Location: chart.php');
} catch (Exception $ex) {
    $_SESSION['error'] = $ex->getMessage();
    header('Location: index.php');
}

