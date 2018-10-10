<?php

namespace app\validators;

/**
 * Class EmailValidator
 * @package app\validators
 */
class EmailValidator implements ValidatorInterface
{
    private const EMAIL_PATTERN = '/^\w+@\w+\.[a-z]{2,6}$/';
    private const EMAIL_ERROR_MSG = 'Invalid email';

    /**
     * Email validation.
     * @param string $email Email as string
     * @return bool Validation result
     */
    public function validate(string $email): bool
    {
        $email = trim($email);

        return empty($email) || preg_match(self::EMAIL_PATTERN, $email);
    }

    /**
     * Get error message.
     * @return string Error message
     */
    public function getErrorMessage(): string
    {
        return self::EMAIL_ERROR_MSG;
    }
}