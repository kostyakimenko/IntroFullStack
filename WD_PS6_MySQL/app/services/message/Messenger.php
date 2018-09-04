<?php

namespace message;

use io\DataIO;

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
     * @param int $msgId Last updated message id
     * @return array New messages
     */
    public function getMsg($msgId = 0)
    {
        return $this->dbIO->selectData($msgId);
    }

    /**
     * Add message to database.
     * @param Message $message Message object
     */
    public function addMsg(Message $message)
    {
        $this->dbIO->insertData($message);
    }
}
