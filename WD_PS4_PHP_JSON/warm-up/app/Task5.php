<?php

namespace app;

/**
 * Class Task5.
 * @package app
 */
class Task5
{
    private $number;

    /**
     * Task5 constructor.
     * @param $number string Number
     */
    public function __construct($number)
    {
        $this->number = $number;
    }

    /**
     * Calculate a sum of digits of input number.
     * @return string Sum of digits
     */
    public function sumDigits()
    {
        if (!is_numeric($this->number)) {
            return 'Error: Input parameter must be a number';
        }

        $formatNumber = preg_replace('/\-|\./', '', $this->number);
        $digits = str_split($formatNumber);
        $result = array_sum($digits);

        return "Result: $result";
    }
}