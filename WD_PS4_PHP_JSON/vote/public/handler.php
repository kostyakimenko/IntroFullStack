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
$table = ($checker->isValidFile()) ? $checker->getTable() : $config['defaultTable'];

/*
 * Change vote and write table.
 * If the write was successful send data to chart page,
 * else return error to main page.
 */
try {
    $item = (isset($_POST['activity'])) ? htmlspecialchars($_POST['activity']) : null;
    $writer = new JsonWriter($table, $item, $config['json']);
    $writer->writeTable();
    header('Location: chart.php');
} catch (Exception $ex) {
    $_SESSION['error'] = $ex->getMessage();
    header('Location: index.php');
}

