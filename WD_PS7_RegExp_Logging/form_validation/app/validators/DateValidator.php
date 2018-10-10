<?php

namespace app\validators;

/**
 * Class DateValidator
 * @package app\validators
 */
class DateValidator implements ValidatorInterface
{
    private const DATE_PATTERN = '/^([1-9]|(0[1-9])|1[0-2])\/([1-9]|(0[1-9])|([12]\d)|(3[01]))\/(?!0{4})\d{4}$/';
    private const DATE_ERROR_MSG = 'invalid date';

    /**
     * Date validation.
     * @param string $date Date as string
     * @return bool Validation result
     */
    public function validate(string $date): bool
    {
        $date = trim($date);

        return empty($date) || preg_match(self::DATE_PATTERN, $date);
    }

    /**
     * Get error message.
     * @return string Error message
     */
    public function getErrorMessage(): string
    {
        return self::DATE_ERROR_MSG;
    }
}
