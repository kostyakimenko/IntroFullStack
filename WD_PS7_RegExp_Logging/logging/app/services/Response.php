<?php

namespace app\services;

/**
 * Class Response.
 * @package app\services
 */
class Response
{
    private $response;

    /**
     * Response constructor.
     */
    public function __construct()
    {
        $this->response = [];
    }

    /**
     * Enter response data.
     * @param string $status Response status
     * @param string $message Response message
     * @param array $data Response data
     */
    public function setResponseData(string $status, string $message, array $data = [])
    {
        $this->response['status'] = $status;
        $this->response['message'] = $message;
        $this->response['data'] = $data;
        $this->response['username'] = $_SESSION['user'] ?? 'unknown';
        $this->response['user_id'] = $_SESSION['user_id'] ?? 'unknown';
        $this->response['client_ip'] = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    }

    /**
     * Get response array
     * @return array Response array
     */
    public function getResponseData()
    {
        return $this->response;
    }

    /**
     * Send response from client.
     */
    public function sendResponse()
    {
        header('Content-type: application/json');
        echo (json_encode($this->response));
    }
}
