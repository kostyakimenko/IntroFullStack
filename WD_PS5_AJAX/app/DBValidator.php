<?php

class DBValidator
{
    private $dbPath;
    private $dbIO;

    /**
     * DatabaseChecker constructor.
     * @param $dbPath
     * @param DatabaseIO $dbIO
     */
    public function __construct($dbPath, $dbIO)
    {
        $this->dbPath = $dbPath;
        $this->dbIO = $dbIO;
    }

    public function isFileValid()
    {
        return is_readable($this->dbPath) && is_writable($this->dbPath);
    }

    public function isContentValid()
    {
        return !is_null($this->dbIO->readData());
    }
}
