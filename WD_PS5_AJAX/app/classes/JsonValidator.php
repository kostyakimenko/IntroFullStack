<?php

/**
 * Class JsonValidator.
 * Json files validation.
 */
class JsonValidator
{
    private $jsonPath;
    private $jsonIO;

    /**
     * JsonValidator constructor.
     * @param string $jsonPath Path to json file
     * @param JsonIO $jsonIO Object for input/output json
     */
    public function __construct($jsonPath, $jsonIO)
    {
        $this->jsonPath = $jsonPath;
        $this->jsonIO = $jsonIO;
    }

    /**
     * Json file validation.
     * @return bool Validation result
     */
    public function isFileValid()
    {
        return is_readable($this->jsonPath) && is_writable($this->jsonPath);
    }

    /**
     * File content validation.
     * @return bool Validation result
     */
    public function isContentValid()
    {
        return !is_null($this->jsonIO->readData());
    }
}
