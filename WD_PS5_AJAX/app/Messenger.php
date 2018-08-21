<?php

class Messenger
{
    private $dbIO;
    private $msgTable;
    private $msgUpdateTime;

    /**
     * Messenger constructor.
     * @param DatabaseIO $dbIO
     */
    public function __construct($dbIO)
    {
        $this->dbIO = $dbIO;
        $this->msgTable = $dbIO->readData();
        $this->msgUpdateTime = $dbIO->updateTime();
    }

    public function getMsg($lastUpdateTime = 0)
    {
        $hourAgo = strtotime('-1 hour');

        return array_filter($this->msgTable, function($msg) use ($lastUpdateTime, $hourAgo) {
            return $msg['time'] > $lastUpdateTime && $msg['time'] > $hourAgo;
        });
    }

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

    public function msgUpdateTime()
    {
        return $this->msgUpdateTime;
    }
}
