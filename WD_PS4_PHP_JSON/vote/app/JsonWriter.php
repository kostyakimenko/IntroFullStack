<?php

/**
 * Class JsonWriter.
 * Change vote counter and write data to the json file.
 */
class JsonWriter
{
    private $dataTable;
    private $item;
    private $jsonPath;

    /**
     * JsonWriter constructor.
     * @param array $table Table as associative array
     * @param string $item Item of the table
     * @param string $jsonPath Path to json file
     */
    public function __construct($table, $item, $jsonPath)
    {
        $this->dataTable = $table;
        $this->item = $item;
        $this->jsonPath = $jsonPath;
    }

    /**
     * Write data table in a json file.
     * If flag 'newFile' is true create new file.
     * @throws Exception Could not create new file or failed write a table
     */
    public function writeTable()
    {
        $this->addVote();

        $isWrite = file_put_contents($this->jsonPath, json_encode($this->dataTable, JSON_PRETTY_PRINT));

        if ($isWrite === false) {
            throw new Exception('Error: could not create file or failed write a data table');
        }
    }

    /**
     * Add vote to the table.
     * @throws Exception Failed item
     */
    private function addVote()
    {
        if (array_key_exists($this->item, $this->dataTable)) {
            $this->dataTable[$this->item]++;
        } else {
            throw new Exception('Error: selected item is not found in data table');
        }
    }
}