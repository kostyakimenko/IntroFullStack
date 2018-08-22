<?php

/**
 * Class DBValidator.
 * Database validation.
 */
class DBValidator
{
    private $dbPath;
    private $dbIO;

    /**
     * DatabaseChecker constructor.
     * @param string $dbPath Path to database
     * @param DatabaseIO $dbIO Object for input/output database
     */
    public function __construct($dbPath, $dbIO)
    {
        $this->dbPath = $dbPath;
        $this->dbIO = $dbIO;
    }

    /**
     * Database file validation.
     * @return bool Validation result
     */
    public function isFileValid()
    {
        return is_readable($this->dbPath) && is_writable($this->dbPath);
    }

    /**
     * File content validation.
     * @return bool Validation result
     */
    public function isContentValid()
    {
        return !is_null($this->dbIO->readData());
    }
}
