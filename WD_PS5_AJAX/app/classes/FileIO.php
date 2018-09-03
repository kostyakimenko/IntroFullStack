<?php

/**
 * Class FileIO.
 * Input and output data of the file.
 */
class FileIO implements DataIO
{
    private $filePath;

    /**
     * FileIO constructor.
     * @param string $filePath Path to the file
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Read file.
     * @return array Data as associative array
     */
    public function readData()
    {
        return json_decode(file_get_contents($this->filePath), true);
    }

    /**
     * Write data to file.
     * @param array $data Data as associative array
     */
    public function writeData($data)
    {
        file_put_contents($this->filePath, json_encode($data, JSON_PRETTY_PRINT));
    }

    /**
     * Get path to the file.
     * @return string Path to the file
     */
    public function getPath()
    {
        return $this->filePath;
    }
}
