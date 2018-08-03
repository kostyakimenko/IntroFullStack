<?php

// Include the configuration file
$config = require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
                  . 'app' . DIRECTORY_SEPARATOR . 'config.php';

// Include the classes (Reader and Writer)
require $config['reader'];
require $config['writer'];

session_start();

/*
 * Read table, change result, write new data
 * and visualization data in chart page.
 * If input data is not correct throw error in start page.
 */
try {
    if (!isset($_POST['activity'])) {
        throw new Exception('Error: transfer of vote result to the server did not occur');
    }

    $item = htmlspecialchars($_POST['activity']);

    $reader = new Reader($item, $config['json'], $config['defaultTable']);
    $table = $reader->readTable();
    $table[$item]++;

    $writer = new Writer($table, $config['json']);
    $writer->writeTable();

    $_SESSION['table'] = $table;
    header('Location: chart.php');
} catch (Exception $ex) {
    $_SESSION['error'] = $ex->getMessage();
    header('Location: index.php');
}

