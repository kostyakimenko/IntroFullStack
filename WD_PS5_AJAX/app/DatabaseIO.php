<?php

class DatabaseIO
{
    private $dbPath;

    public function __construct($dbPath)
    {
        $this->dbPath = $dbPath;
    }

    public function readData()
    {
        return json_decode(file_get_contents($this->dbPath), true);
    }

    public function writeData($data)
    {
        file_put_contents($this->dbPath, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function updateTime()
    {
        clearstatcache();
        return filemtime($this->dbPath);
    }
}
