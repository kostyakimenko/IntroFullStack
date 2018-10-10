<?php

namespace app\services;

/**
 * Class Logger
 * @package app\services
 */
class Logger
{
    private $filePath;

    /**
     * Logger constructor.
     * @param string $filePath
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Logging data
     * @param string $service Service name
     * @param Response $serverResponse Server response object
     */
    public function logging(string $service, Response $serverResponse)
    {
        $respData = $serverResponse->getResponseData();

        $date = date('Y-m-d H:i:s');
        $level = $respData['status'];
        $message = $respData['message'];
        $userID = $respData['user_id'];
        $clientIP = $respData['client_ip'];

        $logMsg = "$date\nlevel=$level\nservice=$service\nmessage=$message\nuserID=$userID\nclientIP=$clientIP\n\n\n";

        file_put_contents($this->filePath, $logMsg, FILE_APPEND);
    }
}
