<?php

/**
 * Class JsonChecker.
 * Validation of json file and json data.
 */
class JsonChecker
{
    private $jsonPath;
    private $jsonExists;
    private $dataTable;

    /**
     * JsonChecker constructor.
     * @param string $jsonPath Path to the json file
     */
    public function __construct($jsonPath)
    {
        $this->jsonPath = $jsonPath;
        $this->jsonExists = file_exists($this->jsonPath);
        $this->dataTable = ($this->jsonExists) ? $this->readTable() : null;
    }

    /**
     * Check json file is valid (exists and not empty).
     * @return bool Result of checking
     */
    public function isValidFile()
    {
        return $this->jsonExists && !empty($this->dataTable);
    }

    /**
     * Get data table.
     * @return array|null Table as associative array
     */
    public function getTable()
    {
        return $this->dataTable;
    }

    /**
     * Read data table from json file
     * @return array Table as associative array
     */
    private function readTable()
    {
        $data = file_get_contents($this->jsonPath);

        return json_decode($data, true);
    }
}