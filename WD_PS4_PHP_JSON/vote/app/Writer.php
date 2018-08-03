<?php

/**
 * Class Writer writes the data in json-file.
 * @package app
 */
class Writer
{
    private $table;
    private $file;

    /**
     * Writer constructor.
     * @param array $table Table as associative array
     * @param string $file Path to file
     */
    public function __construct($table, $file)
    {
        $this->table = $table;
        $this->file = $file;
    }

    /**
     * Write a table in a json-file.
     * If file is not found create new file.
     * @throws Exception Could not create new file
     */
    public function writeTable()
    {
        if (!file_exists($this->file)) {
            fopen($this->file, 'w');
        }

        if (!file_exists($this->file)) {
            throw new Exception('Error: could not create file for data table');
        }

        file_put_contents($this->file, json_encode($this->table, JSON_PRETTY_PRINT));
    }
}