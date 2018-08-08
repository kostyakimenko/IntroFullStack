<?php

/**
 * Class JsonWriter.
 */
class JsonWriter
{
    private $jsonPath;
    private $dataTable;
    private $vote;

    /**
     * JsonWriter constructor.
     * @param string $vote Vote for a candidate
     * @param array $dataTable Data table with vote result
     * @param array $config Configuration parameters
     */
    public function __construct($vote, $dataTable, $config)
    {
        $this->vote = $vote;
        $this->dataTable = $dataTable;
        $this->jsonPath = $config['json'];
    }

    /**
     * Write data table in a json file.
     * @throws Exception Failed write a table
     */
    public function writeTable()
    {
        $this->addVote();

        $isWrite = file_put_contents($this->jsonPath, json_encode($this->dataTable, JSON_PRETTY_PRINT));

        if ($isWrite === false) {
            throw new Exception('Error: failed write a data table');
        }
    }

    /**
     * Add vote to the data table.
     * @throws Exception Failed item
     */
    private function addVote()
    {
        if (array_key_exists($this->vote, $this->dataTable)) {
            $this->dataTable[$this->vote]++;
        } else {
            throw new Exception('Error: selected item is not found in data table');
        }
    }
}
