<?php

/**
 * Class JsonReader
 */
class JsonReader
{
    private $jsonPath;
    private $defaultKeys;
    private $currentTable;

    /**
     * JsonReader constructor.
     * @param array $config Configuration parameters
     */
    public function __construct($config)
    {
        $this->jsonPath = $config['json'];
        $this->defaultKeys = $config['defaultKeys'];
        $this->currentTable = [];
    }

    /**
     * Get data table with vote result.
     * @return array Data table
     */
    public function getTable()
    {
        if ($this->isValidTable()) {
            return $this->currentTable;
        } else {
            return array_fill_keys($this->defaultKeys, 0);
        }
    }

    /**
     * Data table validation.
     * @return bool Result table validation
     */
    private function isValidTable()
    {
        if (is_readable($this->jsonPath)) {
            $this->currentTable = json_decode(file_get_contents($this->jsonPath), true);
        }

        if (empty($this->currentTable)) {
            return false;
        } else {
            $tableDiff = array_diff($this->defaultKeys, array_keys($this->currentTable));
            return empty($tableDiff);
        }
    }
}
