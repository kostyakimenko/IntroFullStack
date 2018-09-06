<?php

/**
 * Class Messenger.
 * Message handling.
 */
class Messenger
{
    private $dbIO;
    private $msgTable;

    /**
     * Messenger constructor.
     * @param DataIO $dbIO Object for input/output database
     * @throws Exception Table is null
     */
    public function __construct(DataIO $dbIO)
    {
        $this->dbIO = $dbIO;
        $this->msgTable = $dbIO->readData();

        if (!isset($this->msgTable)) {
            throw new Exception();
        }
    }

    /**
     * Get new messages on last hour.
     * @param int $updateTime Time of the last update
     * @return array New messages
     */
    public function getMessages($updateTime = 0)
    {
        $hourAgo = strtotime('-1 hour') * 1000;
        $newMessages = [];

        for ($i = count($this->msgTable); $i--;) {
            $msgTime = $this->msgTable[$i]['time'];
            if ($msgTime > $updateTime && $msgTime > $hourAgo) {
                array_unshift($newMessages, $this->msgTable[$i]);
            } else {
                break;
            }
        }

        return $newMessages;
    }

    /**
     * Add message to database.
     * @param string $user User name
     * @param string $msg message
     */
    public function addMessage($user, $msg)
    {
        $message = [];
        $message['time'] = round(microtime(true) * 1000);
        $message['user'] = $user;
        $message['text'] = $msg;

        array_push($this->msgTable, $message);
        $this->dbIO->writeData($this->msgTable);
    }

    /**
     * Get last message time.
     */
    public function lastMsgTime()
    {
        return end($this->msgTable)['time'];
    }
}
