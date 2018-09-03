<?php

/**
 * Class FileValidator.
 */
class FileValidator
{
    private $fileIO;

    /**
     * FileValidator constructor.
     * @param FileIO $fileIO Object for read and write of the file
     */
    public function __construct(FileIO $fileIO)
    {
        $this->fileIO = $fileIO;
    }

    /**
     * Check file.
     * @return bool Validation result
     */
    public function isFileValid()
    {
        return is_readable($this->fileIO->getPath())
            && is_writable($this->fileIO->getPath())
            && !is_null($this->fileIO->readData());
    }
}
