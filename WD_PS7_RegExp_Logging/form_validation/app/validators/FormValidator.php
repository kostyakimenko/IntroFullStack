<?php

namespace app\validators;

use InvalidArgumentException;
use Exception;

/**
 * Class FormValidator
 * @package app\validators
 */
class FormValidator
{
    private $formData;
    private $rules;
    private $errors;

    /**
     * FormValidator constructor.
     * @param array $formData Data of form inputs
     * @param array $rules Rules for form validation
     */
    public function __construct(array $formData, array $rules)
    {
        $this->formData = $formData;
        $this->rules = $rules;
        $this->errors = [];
    }

    /**
     * Check form data.
     * @return bool Validation result
     * @throws Exception
     */
    public function isFormValid(): bool
    {
        foreach ($this->rules as $inputName => $rule) {
            if (!array_key_exists($inputName, $this->formData)) {
                throw new InvalidArgumentException("$inputName not found");
            }

            $this->validate($inputName, explode('|', $rule));
        }

        return empty($this->errors);
    }

    /**
     * Get error messages.
     * @return array Errors as array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Validate form input
     * @param string $inputName Input name
     * @param array $validators List of validators
     * @throws Exception
     */
    private function validate(string $inputName, array $validators)
    {
        foreach ($validators as $validator) {
            $validator = $this->makeValidator($validator);

            if (!$validator->validate($this->formData[$inputName])) {
                $this->errors[$inputName] = $validator->getErrorMessage();
            }
        }
    }

    /**
     * Get validator object
     * @param string $validator Validator name
     * @return ValidatorInterface validator object
     * @throws Exception
     */
    private function makeValidator(string $validator): ValidatorInterface
    {
        $classname = __NAMESPACE__ . '\\' . $validator . 'Validator';

        if (!class_exists($classname)) {
            throw new Exception("Class $classname not found");
        }

        $validator = new $classname();

        if (!$validator instanceof ValidatorInterface) {
            throw new Exception("Class $classname type error");
        }

        return $validator;
    }
}
