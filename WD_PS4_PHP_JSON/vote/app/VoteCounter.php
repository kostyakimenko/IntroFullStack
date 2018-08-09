<?php

/**
 * Class VoteCounter.
 * Read table, add vote and write table.
 */
class VoteCounter
{
    private $tablePath;
    private $defaultKeys;

    /**
     * VoteCounter constructor.
     * @param string $tablePath Path to data table
     * @param array $defaultKeys List of default keys for voting
     */
    public function __construct($tablePath, $defaultKeys)
    {
        $this->tablePath = $tablePath;
        $this->defaultKeys = $defaultKeys;
    }

    /**
     * Get default data table
     * @return array Default data table
     */
    public function getDefaultTable()
    {
        return array_fill_keys($this->defaultKeys, 0);
    }

    /**
     * Get data table.
     * If current table is valid -return current table,
     * else - return default table.
     * @return array Data table
     */
    public function getTable()
    {
        $currentTable = json_decode(file_get_contents($this->tablePath), true);

        if ($this->isValidTable($currentTable)) {
            return $currentTable;
        } else {
            return $this->getDefaultTable();
        }
    }

    /**
     * Check data table.
     * @param array $table Data table
     * @return bool Checking result
     */
    private function isValidTable($table)
    {
        if (empty($table)) {
            return false;
        } else {
            return $this->defaultKeys === array_keys($table);
        }
    }

    /**
     * Add vote to the data table.
     * @param string $vote Vote
     * @param array $dataTable Data table with vote result
     * @throws Exception Selected candidate isn't found in data table
     */
    public function addVote($vote, &$dataTable)
    {
        if (array_key_exists($vote, $dataTable)) {
            $dataTable[$vote]++;
        } else {
            throw new Exception('Selected item is not found in data table');
        }
    }

    /**
     * Put table to the json.
     * @param array $dataTable Data table with vote result
     */
    public function putTable($dataTable)
    {
        file_put_contents($this->tablePath, json_encode($dataTable, JSON_PRETTY_PRINT));
    }
}
