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
     * @param string $error Response error
     * @param array $data Response data
     */
    public function responseData(string $status, string $error = '', array $data = [])
    {
        $this->response['status'] = $status;
        $this->response['error'] = $error;
        $this->response['data'] = $data;
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
