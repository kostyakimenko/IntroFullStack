<?php

namespace app;

use Exception;

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
     * @throws Exception Error when item in not found in table
     */
    public function readTable()
    {
        if (file_exists($this->file) === false) {
            $table = $this->defaultTable;
        } else {
            $data = file_get_contents($this->file);
            $table = json_decode($data, true);
        }

        if (array_key_exists($this->item, $table) === false) {
            throw new Exception('Selected item is not found in data table');
        }

        return $table;
    }
}