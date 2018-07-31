<?php

spl_autoload_register(function ($className) {
    include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .
        str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
});

use app\Task1;
use app\Task2;
use app\Task3;
use app\Task4;
use app\Task5;
use app\Task6;

session_start();
$key = end(array_keys(($_POST))); // last key in post array

/*
 * Select of the object for solving problem.
 * The result is written to the session array
 * and sent to the main page using header().
 */
switch ($key) {
    case 'task1_submit':
        $taskObj = new Task1();
        $_SESSION['task1'] = $taskObj->getSumOfRange();
        $_SESSION['taskName'] = 'task1';
        break;
    case 'task2_submit':
        $taskObj = new Task2();
        $_SESSION['task2'] = $taskObj->getSumOfRange();
        $_SESSION['taskName'] = 'task2';
        break;
    case 'task3_submit':
        $taskObj = new Task3();
        $_SESSION['task3'] = $taskObj->drawPyramid();
        $_SESSION['taskName'] = 'task3';
        break;
    case 'task4_submit':
        $rows = htmlspecialchars($_POST['rows']);
        $cols = htmlspecialchars($_POST['cols']);
        $taskObj = new Task4($rows, $cols);
        $_SESSION['task4'] = $taskObj->drawChessboard();
        $_SESSION['taskName'] = 'task4';
        break;
    case 'task5_submit':
        $number = htmlspecialchars($_POST['number']);
        $taskObj = new Task5($number);
        $_SESSION['task5'] = $taskObj->sumDigits();
        $_SESSION['taskName'] = 'task5';
        break;
    case 'task6_submit':
        $taskObj = new Task6();
        $_SESSION['task6'] = $taskObj->randomArray();
        $_SESSION['taskName'] = 'task6';
        break;
}

header('location: index.php');

