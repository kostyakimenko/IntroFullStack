<?php

/**
 * Class Reader reads the json-file
 * and converts the data into an associative array.
 * @package app
 */
class Reader
{
    private $item;
    private $file;
    private $defaultTable;

    /**
     * Reader constructor.
     * @param $item string Item of the table
     * @param $file string Path to json-file
     * @param $defaultTable array Default table
     */
    public function __construct($item, $file, $defaultTable)
    {
        $this->item = $item;
        $this->file = $file;
        $this->defaultTable = $defaultTable;
    }

    /**
     * Read table in the json-file.
     * @return array|mixed Table as associative array
     * @throws Exception Item in not found in table
     */
    public function readTable()
    {
        if (file_exists($this->file)) {
            $data = file_get_contents($this->file);
            $table = json_decode($data, true);
        } else {
            $table = $this->defaultTable;
        }

        if (!isset($table) || !array_key_exists($this->item, $table)) {
            throw new Exception('Error: selected item is not found in data table');
        }

        return $table;
    }
}