<?php

namespace app\validators;

/**
 * Interface ValidatorInterface
 * @package app\validators
 */
interface ValidatorInterface
{
    public function validate(string $value): bool;
    public function getErrorMessage(): string;
}