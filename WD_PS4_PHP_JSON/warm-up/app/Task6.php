<?php

namespace app;

/**
 * Class Task6.
 * @package app
 */
class Task6
{
    const ARR_LENGTH = 100;
    const FROM_NUMBER = 1;
    const TO_NUMBER = 10;

    /**
     * Get array of random numbers,
     * get unique numbers, sort and reverse array.
     * @return array Sorted array
     */
    public function randomArray()
    {
        $randomNumbers = array();

        for ($i = 0; $i < self::ARR_LENGTH; $i++) {
            array_push($randomNumbers, rand(self::FROM_NUMBER, self::TO_NUMBER));
        }

        $uniqueNumbers = array_unique($randomNumbers);
        rsort($uniqueNumbers);

        return $uniqueNumbers;
    }
}