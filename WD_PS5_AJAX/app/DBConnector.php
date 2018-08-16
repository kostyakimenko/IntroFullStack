<?php

class DBConnector
{
    private $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function isFileExists()
    {
        return file_exists($this->filePath);
    }

    public function isFileValid()
    {
        return is_readable($this->filePath) && is_writable($this->filePath);
    }

    public function isDirValid()
    {
        return is_readable(dirname($this->filePath)) && is_writable(dirname($this->filePath));
    }

    public function isContentValid()
    {
        $content = file_get_contents($this->filePath);
        $firstChar = $content[0];
        $lastChar = $content[strlen($content) - 1];

        return ($firstChar === '{' && $lastChar === '}')
               || ($firstChar === '[' && $lastChar === ']');
    }

    public function createEmptyFile()
    {
        file_put_contents($this->filePath, '[]');
    }
}