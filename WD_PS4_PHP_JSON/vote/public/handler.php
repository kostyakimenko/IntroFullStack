<?php

include __DIR__ . '/../app/config.php';
include __DIR__ . '/../app/Reader.php';
include __DIR__ . '/../app/Writer.php';

use app\Reader;
use app\Writer;

session_start();
$item = htmlspecialchars($_POST['activity']);

/*
 * Read table, change result, write new data
 * and visualization data in chart page.
 * If input data is not correct throw error in start page.
 */
try {
    $reader = new Reader($item, $jsonPath, $defaultTable);
    $table = $reader->readTable();
    $table[$item]++;

    $writer = new Writer($table, $jsonPath);
    $writer->writeTable();

    $_SESSION['table'] = $table;
    header('Location: chart.php');
} catch (Exception $ex) {
    $_SESSION['error'] = $ex->getMessage();
    header('Location: index.php');
}

