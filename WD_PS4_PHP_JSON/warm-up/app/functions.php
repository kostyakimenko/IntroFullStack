<?php

const MIN_NUMBER = -1000; // for sumAll (task1) and sumAllOf (task2)
const MAX_NUMBER = 1000; // for sumAll (task1) and sumAllOf (task2)
const LAST_DIGITS = [2, 3, 7]; // for sumAllOf (task2)
const PYRAMID_ROWS = 50; // for pyramid (task3)
const ARR_LENGTH = 100; // for random array (task6)
const CHESS_SIZE_LIMIT = 50; // for chessboard (task4)

/**
 * Task1.
 * Сalculate a sum of all numbers from -1000 to 1000.
 * @return string Sum of numbers of range
 */
function sumAll()
{
    return array_sum(range(MIN_NUMBER, MAX_NUMBER));
}

/**
 * Task2.
 * Сalculate a sum of all numbers from -1000 to 1000
 * in which last digits ends in 2, 3, or 7.
 * @return string Sum of number of range.
 */
function sumAllOf()
{
    $sumOfRange = 0;

    for ($i = MIN_NUMBER; $i <= MAX_NUMBER; $i++) {
        $lastDigit = abs($i) % 10;
        if (in_array($lastDigit, LAST_DIGITS)) {
            $sumOfRange += $i;
        }
    }

    return $sumOfRange;
}

/**
 * Task3.
 * Draw a half of pyramid (50 rows).
 * @return string Pyramid as string of '*'
 */
function drawPyramid()
{
    $pyramid = '';

    for ($i = 1; $i <= PYRAMID_ROWS; $i++) {
        $row = str_repeat('*', $i);
        $pyramid .= "$row\n";
    }

    return nl2br($pyramid);
}

/**
 * Task4.
 * Draw a chessboard of a given size.
 * @param string $rows Rows number
 * @param string $cols Cols number
 * @return string Chessboard as html
 * @throws Exception Input value isn't a positive integer
 *         Exception Chessboard size limit is exceeded
 */
function drawChessboard($rows, $cols)
{
    if (!filter_var($rows, FILTER_VALIDATE_INT) || !filter_var($cols, FILTER_VALIDATE_INT)
        || $rows < 1 || $cols < 1) {
        throw new Exception('Error: input parameters must be a positive integer');
    }

    if ($rows > CHESS_SIZE_LIMIT || $cols > CHESS_SIZE_LIMIT) {
        throw new Exception('Error: chessboard size limit is ' . CHESS_SIZE_LIMIT);
    }

    $chessboard = '';
    $startRow = '{start}';
    $endRow = '{end}';
    $blackCell = '{black}';
    $whiteCell = '{white}';

    for ($row = 0; $row < $rows; $row++) {
        $newRow = $startRow;
        for ($col = 0; $col < $cols; $col++) {
            $newRow .= (($row + $col) % 2 === 0) ? $blackCell : $whiteCell;
        }
        $chessboard .= $newRow . $endRow;
    }

    return $chessboard;
}

/**
 * Task5.
 * Calculate a sum of digits of input number.
 * @param string $number Input number
 * @return string Sum of digits
 * @throws Exception Input value isn't a number
 */
function sumDigits($number)
{
    if (!is_numeric($number)) {
        throw new Exception('Error: Input parameter must be a number');
    }

    $formatNumber = preg_replace('/\-|\./', '', $number);
    $digits = str_split($formatNumber);

    return array_sum($digits);
}

/**
 * Task6.
 * Get array of random numbers,
 * get unique numbers, sort and reverse array.
 * @return array Sorted array
 */
function randomArray()
{
    $randomNumbers = [];

    for ($i = 0; $i < ARR_LENGTH; $i++) {
        array_push($randomNumbers, mt_rand(1, 10));
    }

    $uniqueNumbers = array_unique($randomNumbers);
    rsort($uniqueNumbers);

    return $uniqueNumbers;
}
