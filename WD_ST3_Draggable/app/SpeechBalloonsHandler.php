<?php

/**
 * Class SpeechBalloonsHandler
 */
class SpeechBalloonsHandler
{
    private $filePath;

    /**
     * SpeechBalloonsHandler constructor.
     * @param string $filePath Path to file with balloons info
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Write new info to file.
     * @param array $speechBalloons Speech balloons info
     */
    public function writeInfo(array $speechBalloons)
    {
        file_put_contents($this->filePath, json_encode($speechBalloons, JSON_PRETTY_PRINT));
    }

    /**
     * Read info in json file.
     * @return string Json format data
     */
    public function readInfo()
    {
        return file_get_contents($this->filePath);
    }
}