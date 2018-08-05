<?php

// Include main class with functions for solving problem
require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'functions.php';

session_start();

$_SESSION['taskName'] = htmlspecialchars($_POST['taskName']);

/*
 * Select of the function for solving problem.
 * The result is written to the session array
 * and sent to the main page using header().
 */
switch ($_SESSION['taskName']) {
    case 'task1':
        $_SESSION['task1'] = sumAll();
        break;
    case 'task2':
        $_SESSION['task2'] = sumAllOf();
        break;
    case 'task3':
        $_SESSION['task3'] = drawPyramid();
        break;
    case 'task4':
        $rows = htmlspecialchars($_POST['rows']);
        $cols = htmlspecialchars($_POST['cols']);
        try {
            $_SESSION['task4'] = drawChessboard($rows, $cols);
        } catch (Exception $ex) {
            $_SESSION['errTask4'] = $ex->getMessage();
        }
        break;
    case 'task5':
        $number = htmlspecialchars($_POST['number']);
        try {
            $_SESSION['task5'] = sumDigits($number);
        } catch (Exception $ex) {
            $_SESSION['errTask5'] = $ex->getMessage();
        }
        break;
    case 'task6':
        $_SESSION['task6'] = randomArray();
        break;
}

header('location: index.php');