<?php

namespace message;

/**
 * Class Message.
 * @package message
 */
class Message
{
    private $user;
    private $message;

    /**
     * Message constructor.
     * @param string $user User name
     * @param string $message Message
     */
    public function __construct($user, $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Get user name.
     * @return string User name
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get message.
     * @return string Message
     */
    public function getMsg()
    {
        return $this->message;
    }

}
