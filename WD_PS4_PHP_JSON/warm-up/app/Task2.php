<?php

namespace app;

/**
 * Class Task2.
 * @package app
 */
class Task2
{
    const MIN_NUMBER = -1000;
    const MAX_NUMBER = 1000;

    /**
     * Сalculate a sum of all numbers from -1000 to 1000
     * in which last digits ends in 2, 3, or 7.
     * @return string Sum of number of range.
     */
    public function getSumOfRange()
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
}