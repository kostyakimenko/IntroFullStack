<?php

class Messenger
{
    private $filePath;
    private $msgTable;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
        $this->msgTable = $this->readTable();
    }

    private function readTable()
    {
        return json_decode(file_get_contents($this->filePath), true);
    }

    public function getLastHoursMsg()
    {
        $hourAgo = strtotime('-1 hour');
        $lastHoursMsg = [];

        foreach ($this->msgTable as $msg) {
            if ($msg['time'] > $hourAgo) {
                array_push($lastHoursMsg, $msg);
            }
        }

        return $lastHoursMsg;
    }

    public function addMsg($user, $msg)
    {
        $message = [];
        $message['time'] = time();
        $message['user'] = $user;
        $message['text'] = $msg;

        array_push($this->msgTable, $message);
        file_put_contents($this->filePath, json_encode($this->msgTable, JSON_PRETTY_PRINT ));
    }
}
