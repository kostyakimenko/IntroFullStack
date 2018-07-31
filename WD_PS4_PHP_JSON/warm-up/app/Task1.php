<?php

namespace app;

/**
 * Class Task1.
 * @package app
 */
class Task1
{
    const MIN_NUMBER = -1000;
    const MAX_NUMBER = 1000;

    /**
     * Сalculate a sum of all numbers from -1000 to 1000.
     * @return string Sum of numbers of range
     */
    public function getSumOfRange()
    {
        $sumOfRange = array_sum(range(self::MIN_NUMBER, self::MAX_NUMBER));

        return "Result: $sumOfRange";
    }
}