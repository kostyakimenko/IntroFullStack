<?php

namespace app\validators;

/**
 * Class IpValidator
 * @package app\validators
 */
class IpValidator implements ValidatorInterface
{
    private const IP_PATTERN = '/^((\d|[1-9]\d|1\d{2}|2[0-4]\d|25[0-5])\.){3}(\d|[1-9]\d|1\d{2}|2[0-4]\d|25[0-5])$/';
    private const IP_ERROR_MSG = 'Invalid ip';

    /**
     * IP validation.
     * @param string $ip IP as string
     * @return bool Validation result
     */
    public function validate(string $ip): bool
    {
        $ip = trim($ip);

        return empty($ip) || preg_match(self::IP_PATTERN, $ip);
    }

    /**
     * Get error message.
     * @return string Error message
     */
    public function getErrorMessage(): string
    {
        return self::IP_ERROR_MSG;
    }
}