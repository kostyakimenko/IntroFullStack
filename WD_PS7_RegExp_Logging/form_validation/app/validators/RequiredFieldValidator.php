<?php

namespace app\validators;

/**
 * Class RequiredFieldValidator
 * @package app\validators
 */
class RequiredFieldValidator implements ValidatorInterface
{
    private const ERROR_MSG = 'required field';

    /**
     * Check filling the field.
     * @param string $value Field value
     * @return bool Validation result
     */
    public function validate(string $value): bool
    {
        return !empty($value);
    }

    /**
     * Get error message.
     * @return string Error message
     */
    public function getErrorMessage(): string
    {
        return self::ERROR_MSG;
    }
}