<?php

// Include the configuration file
$config = require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
                  . 'config' . DIRECTORY_SEPARATOR . 'config.php';

// Include the classes (JsonChecker and VoteCounter)
require $config['jsonChecker'];
require $config['voteCounter'];

session_start();

// Create checker and vote counter objects
$checker = new JsonChecker($config['json']);
$voteCounter = new VoteCounter($config['json'], $config['defaultKeys']);

/*
 * Validation file and directory,
 * add vote to data table and write table to json file.
 */
try {
    if ($checker->isJsonValid()) {
        $dataTable = $voteCounter->getTable();
    } elseif (!$checker->isJsonExists() && $checker->isDirValid()) {
        $dataTable = $voteCounter->getDefaultTable();
    } else {
        throw new Exception('Access file error');
    }

    $vote = (isset($_POST['activity'])) ? htmlspecialchars($_POST['activity']) : null;
    $voteCounter->putTable($vote, $dataTable);

    header('Location: chart.php');
} catch (Exception $ex) {
    $_SESSION['error'] = $ex->getMessage();
    header('Location: index.php');
}
