<?php

/**
 * Class DatabaseIO.
 * Input and output data to the database.
 */
class DatabaseIO
{
    private $dbPath;

    /**
     * DatabaseIO constructor.
     * @param string $dbPath Path to the database
     */
    public function __construct($dbPath)
    {
        $this->dbPath = $dbPath;
    }

    /**
     * Read data.
     * @return array Data as associative array
     */
    public function readData()
    {
        return json_decode(file_get_contents($this->dbPath), true);
    }

    /**
     * Write data to database.
     * @param array $data Data as associative array
     */
    public function writeData($data)
    {
        file_put_contents($this->dbPath, json_encode($data, JSON_PRETTY_PRINT));
    }

    /**
     * Get database size.
     * @return int Database size
     */
    public function databaseSize()
    {
        clearstatcache();
        return filesize($this->dbPath);
    }
}
