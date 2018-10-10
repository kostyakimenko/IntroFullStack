<?php

namespace app\validators;

/**
 * Class UrlValidator
 * @package app\validators
 */
class UrlValidator implements ValidatorInterface
{
    private const URL_PATTERN = '/^(https?|ftp):\/\/(w{3}\.)?\w+\.[a-z]{2,6}(\/\w*)*$/';
    private const URL_ERROR_MSG = 'Invalid url';

    /**
     * Url validation.
     * @param string $url Url as string
     * @return bool Validation result
     */
    public function validate(string $url): bool
    {
        $url = trim($url);

        return empty($url) || preg_match(self::URL_PATTERN, $url);
    }

    /**
     * Get error message.
     * @return string Error message
     */
    public function getErrorMessage(): string
    {
        return self::URL_ERROR_MSG;
    }
}
