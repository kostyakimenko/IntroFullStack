<?php

/**
 * Class JsonIO.
 * Input and output data to the json file.
 */
class JsonIO implements DataIO
{
    private $jsonPath;

    /**
     * JsonIO constructor.
     * @param string $jsonPath Path to the json file
     */
    public function __construct($jsonPath)
    {
        $this->jsonPath = $jsonPath;
    }

    /**
     * Read json.
     * @return array Data as associative array
     */
    public function readData()
    {
        return json_decode(file_get_contents($this->jsonPath), true);
    }

    /**
     * Write data to json file.
     * @param array $data Data as associative array
     */
    public function writeData($data)
    {
        file_put_contents($this->jsonPath, json_encode($data, JSON_PRETTY_PRINT));
    }

    /**
     * Get file size.
     * @return int File size
     */
    public function databaseSize()
    {
        clearstatcache();
        return filesize($this->jsonPath);
    }
}
