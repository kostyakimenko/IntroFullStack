<?php

namespace app\services\message;

use app\services\DataIO;

/**
 * Class Messenger.
 * Message handling.
 * @package message
 */
class Messenger
{
    private $dbIO;

    /**
     * Messenger constructor.
     * @param DataIO $dbIO Object for input/output database
     */
    public function __construct(DataIO $dbIO)
    {
        $this->dbIO = $dbIO;
    }

    /**
     * Get new messages on last hour.
     * @param int $lastMsgId Last updated message id
     * @return array New messages
     */
    public function getMessages($lastMsgId = 0)
    {
        return $this->dbIO->selectData($lastMsgId);
    }

    /**
     * Add message to database.
     * @param Message $message Message object
     */
    public function addMessage(Message $message)
    {
        $this->dbIO->insertData($message);
    }
}
