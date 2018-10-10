<?php

namespace app\validators;

/**
 * Class TimeValidator
 * @package app\validators
 */
class TimeValidator implements ValidatorInterface
{
    private const TIME_PATTERN = '/^([01]\d|2[0-3])(:([0-5]\d)){2}$/';
    private const TIME_ERROR_MSG = 'Invalid time';

    /**
     * Time validation.
     * @param string $time Time as string
     * @return bool Validation result
     */
    public function validate(string $time): bool
    {
        $time = trim($time);

        return empty($time) || preg_match(self::TIME_PATTERN, $time);
    }

    /**
     * Get error message.
     * @return string Error message
     */
    public function getErrorMessage(): string
    {
        return self::TIME_ERROR_MSG;
    }
}