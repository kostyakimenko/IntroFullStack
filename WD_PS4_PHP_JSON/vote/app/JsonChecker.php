<?php

/**
 * Class JsonChecker.
 * Validation of json file and directory.
 */
class JsonChecker
{
    private $jsonFilePath;
    private $jsonDirPath;

    /**
     * JsonChecker constructor.
     * @param string $json Path to json file
     */
    public function __construct($json)
    {
        $this->jsonFilePath = $json;
        $this->jsonDirPath = dirname($json);
    }

    /**
     * Checking - Is exists json file
     * @return bool Checking result
     */
    public function isJsonExists()
    {
        return file_exists($this->jsonFilePath);
    }

    /**
     * Checking - Is readable and writable json file
     * @return bool Checking result
     */
    public function isJsonValid()
    {
        return is_readable($this->jsonFilePath) && is_writable($this->jsonFilePath);
    }

    /**
     * Checking - Is readable and writable directory
     * @return bool Checking result
     */
    public function isDirValid()
    {
        return is_readable($this->jsonDirPath) && is_writable($this->jsonDirPath);
    }
}
