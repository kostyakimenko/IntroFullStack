<?php

/**
 * Class Messenger.
 * Message handling.
 */
class Messenger
{
    private $dbIO;
    private $msgTable;
    private $msgUpdateTime;

    /**
     * Messenger constructor.
     * @param DatabaseIO $dbIO Object for input/output database
     */
    public function __construct($dbIO)
    {
        $this->dbIO = $dbIO;
        $this->msgTable = $dbIO->readData();
        $this->msgUpdateTime = $dbIO->updateTime();
    }

    /**
     * Get new messages on last hour.
     * @param int $updateTime Time of the last message added
     * @return array New messages
     */
    public function getMsg($updateTime = 0)
    {
        $hourAgo = strtotime('-1 hour');

        return array_filter($this->msgTable, function($msg) use ($updateTime, $hourAgo) {
            return $msg['time'] > $updateTime && $msg['time'] > $hourAgo;
        });
    }

    /**
     * Add message to database.
     * @param string $user User name
     * @param string $msg message
     */
    public function addMsg($user, $msg)
    {
        $message = [];
        $message['time'] = time();
        $message['user'] = $user;
        $message['text'] = $msg;

        array_push($this->msgTable, $message);
        $this->dbIO->writeData($this->msgTable);
        $this->msgUpdateTime = $this->dbIO->updateTime();
    }

    /**
     * Get last update time.
     */
    public function msgUpdateTime()
    {
        return $this->msgUpdateTime;
    }
}
