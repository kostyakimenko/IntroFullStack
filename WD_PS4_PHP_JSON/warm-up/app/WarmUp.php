<?php

namespace app;

/**
 * Class WarmUp.
 * @package app
 */
class WarmUp
{
    const MIN_NUMBER = -1000; // for sumAll (task1) and sumAllOf (task2)
    const MAX_NUMBER = 1000; // for sumAll (task1) and sumAllOf (task2)
    const PYRAMID_ROWS = 50; // for pyramid (task3)
    const ARR_LENGTH = 100; // for random array (task6)
    const CHESS_BLACK = '<div class="chessboard__col_black"></div>'; // for chessboard (task4)
    const CHESS_WHITE = '<div class="chessboard__col_white"></div>'; // for chessboard (task4)
    const CHESS_ROW_START_TAG = '<div class="chessboard__row">'; // for chessboard (task4)
    const CHESS_ROW_END_TAG = '</div>'; // for chessboard (task4)

    /**
     * Task1.
     * Сalculate a sum of all numbers from -1000 to 1000.
     * @return string Sum of numbers of range
     */
    public static function sumAll()
    {
        $sumOfRange = array_sum(range(self::MIN_NUMBER, self::MAX_NUMBER));

        return "Result: $sumOfRange";
    }

    /**
     * Task2.
     * Сalculate a sum of all numbers from -1000 to 1000
     * in which last digits ends in 2, 3, or 7.
     * @return string Sum of number of range.
     */
    public static function sumAllOf()
    {
        $sumOfRange = 0;

        for ($i = self::MIN_NUMBER; $i <= self::MAX_NUMBER; $i++) {
            $endDigit = abs($i) % 10;
            if ($endDigit === 2 || $endDigit === 3 || $endDigit === 7) {
                $sumOfRange += $i;
            }
        }

        return "Result: $sumOfRange";
    }

    /**
     * Task3.
     * Draw a half of pyramid (50 rows).
     * @return string Pyramid as string of '*'
     */
    public static function drawPyramid()
    {
        $row = $pyramid = '';

        for ($i = 0; $i < self::PYRAMID_ROWS; $i++) {
            $row .= '*';
            $pyramid .= "$row\n";
        }

        return nl2br($pyramid);
    }

    /**
     * Task4.
     * Draw a chessboard of a given size.
     * @param $rows string Rows number
     * @param $cols string Cols number
     * @return string Chessboard as html
     */
    public static function drawChessboard($rows, $cols)
    {
        if (!is_int($rows * 1) || !is_int($cols * 1) || $rows < 1 || $cols < 1) {
            return 'Error: input parameters must be a positive integer';
        }

        $chessBoard = '';

        for ($row = 0; $row < $rows; $row++) {
            $newRow = self::CHESS_ROW_START_TAG;
            for ($col = 0; $col < $cols; $col++) {
                if ($row % 2 === 0) {
                    $newRow = ($col % 2 === 0) ? $newRow . self::CHESS_BLACK
                        : $newRow . self::CHESS_WHITE;
                } else {
                    $newRow = ($col % 2 === 0) ? $newRow . self::CHESS_WHITE
                        : $newRow . self::CHESS_BLACK;
                }
            }
            $chessBoard .= $newRow . self::CHESS_ROW_END_TAG;
        }

        return $chessBoard;
    }

    /**
     * Task5.
     * Calculate a sum of digits of input number.
     * @param $number string Input number
     * @return string Sum of digits
     */
    public static function sumDigits($number)
    {
        if (!is_numeric($number)) {
            return 'Error: Input parameter must be a number';
        }

        $formatNumber = preg_replace('/\-|\./', '', $number);
        $digits = str_split($formatNumber);
        $result = array_sum($digits);

        return "Result: $result";
    }

    /**
     * Task6.
     * Get array of random numbers,
     * get unique numbers, sort and reverse array.
     * @return array Sorted array
     */
    public static function randomArray()
    {
        $randomNumbers = array();

        for ($i = 0; $i < self::ARR_LENGTH; $i++) {
            array_push($randomNumbers, rand(1, 10));
        }

        $uniqueNumbers = array_unique($randomNumbers);
        rsort($uniqueNumbers);

        return $uniqueNumbers;
    }
}