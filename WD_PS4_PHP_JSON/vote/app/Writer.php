<?php

namespace app;

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
     * @param $table array Table as associative array
     * @param $file string Path to file
     */
    public function __construct($table, $file)
    {
        $this->table = $table;
        $this->file = $file;
    }

    /**
     * Write a table in a json-file.
     * If file is not found create new file.
     */
    public function writeTable()
    {
        if (file_exists($this->file) === false) {
            fopen($this->file, 'w');
        }

        file_put_contents($this->file, json_encode($this->table, JSON_PRETTY_PRINT));
    }
}