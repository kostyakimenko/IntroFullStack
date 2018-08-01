<?php

include __DIR__ . '/../app/WarmUp.php';

use app\WarmUp;

session_start();
$key = end(array_keys(($_POST))); // last key in post array

/*
 * Select of the object for solving problem.
 * The result is written to the session array
 * and sent to the main page using header().
 */
switch ($key) {
    case 'task1_submit':
        $_SESSION['task1'] = WarmUp::sumAll();
        $_SESSION['taskName'] = 'task1';
        break;
    case 'task2_submit':
        $_SESSION['task2'] = WarmUp::sumAllOf();
        $_SESSION['taskName'] = 'task2';
        break;
    case 'task3_submit':
        $_SESSION['task3'] = WarmUp::drawPyramid();
        $_SESSION['taskName'] = 'task3';
        break;
    case 'task4_submit':
        $rows = htmlspecialchars($_POST['rows']);
        $cols = htmlspecialchars($_POST['cols']);
        $_SESSION['task4'] = WarmUp::drawChessboard($rows, $cols);
        $_SESSION['taskName'] = 'task4';
        break;
    case 'task5_submit':
        $number = htmlspecialchars($_POST['number']);
        $_SESSION['task5'] = WarmUp::sumDigits($number);
        $_SESSION['taskName'] = 'task5';
        break;
    case 'task6_submit':
        $_SESSION['task6'] = WarmUp::randomArray();
        $_SESSION['taskName'] = 'task6';
        break;
}

header('location: index.php');

