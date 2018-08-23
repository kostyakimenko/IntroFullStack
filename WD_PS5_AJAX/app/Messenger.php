<?php

/**
 * Class Messenger.
 * Message handling.
 */
class Messenger
{
    private $dbIO;
    private $msgTable;
    private $lastMsgTime;

    /**
     * Messenger constructor.
     * @param DatabaseIO $dbIO Object for input/output database
     */
    public function __construct($dbIO)
    {
        $this->dbIO = $dbIO;
        $this->msgTable = $dbIO->readData();
        $this->lastMsgTime = null;
    }

    /**
     * Get new messages on last hour.
     * @param int $updateTime Time of the last update
     * @return array New messages
     */
    public function getNewMsg($updateTime = 0)
    {
        $hourAgo = strtotime('-1 hour') * 1000;
        $newMessages = [];

        for ($i = count($this->msgTable); $i--;) {
            $msgTime = $this->msgTable[$i]['time'];
            if ($msgTime > $updateTime && $msgTime > $hourAgo) {
                array_unshift($newMessages, $this->msgTable[$i]);
            }
        }

        $this->lastMsgTime = end($this->msgTable)['time'];

        return $newMessages;
    }

    /**
     * Add message to database.
     * @param string $user User name
     * @param string $msg message
     */
    public function addMsg($user, $msg)
    {
        $message = [];
        $message['time'] = round(microtime(true) * 1000);
        $message['user'] = $user;
        $message['text'] = $msg;

        array_push($this->msgTable, $message);
        $this->dbIO->writeData($this->msgTable);
        $this->lastMsgTime = $message['time'];
    }

    /**
     * Get last message time.
     */
    public function lastMsgTime()
    {
        return $this->lastMsgTime;
    }
}
