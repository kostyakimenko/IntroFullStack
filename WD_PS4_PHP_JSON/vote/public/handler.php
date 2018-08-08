<?php

// Include the configuration file
$config = require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
                  . 'config' . DIRECTORY_SEPARATOR . 'config.php';

// Include the classes (JsonReader and JsonWriter)
require $config['reader'];
require $config['writer'];

session_start();

// Read the data table
$reader = new JsonReader($config);
$dataTable = $reader->getTable();

// Add vote and write the data table
$vote = (isset($_POST['activity'])) ? htmlspecialchars($_POST['activity']) : null;
$writer = new JsonWriter($vote, $dataTable, $config);

try {
    $writer->writeTable();
    header('Location: chart.php');
} catch (Exception $ex) {
    $_SESSION['error'] = $ex->getMessage();
    header('Location: index.php');
}
