<?php

namespace app\services\message;

use app\services\io\DataIO;
use app\services\io\DBConnector;

/**
 * Class MessageDataIO.
 * Input and output message data to the database.
 * @package message
 */
class MessageDataIO implements DataIO
{
    private $conn;

    /**
     * MessageDataIO constructor.
     * @param DBConnector $conn Object for connection
     */
    public function __construct(DBConnector $conn)
    {
        $this->conn = $conn;
    }

    /**
     * Select data.
     * @param int $lastMsgId Last message id
     * @return array Message data
     */
    public function selectData($lastMsgId)
    {
        $sql = "SELECT * FROM messages WHERE id > $lastMsgId AND time > now() - INTERVAL 1 HOUR";

        $messages = [];

        foreach ($this->conn->query($sql) as $row) {
            $message = [];
            $message['id'] = $row['id'];
            $message['time'] = $row['time'];
            $message['user'] = $row['user'];
            $message['text'] = $row['message'];
            array_push($messages, $message);
        }

        return $messages;
    }

    /**
     * Insert data.
     * @param Message $message Message object
     */
    public function insertData($message)
    {
        $user = $message->getUser();
        $msg = $message->getMsg();

        $sql = "INSERT INTO messages (user, message) VALUES ('$user', '$msg')";
        $this->conn->query($sql);
    }

    /**
     * Check updating of the message table.
     * @param int $msgId Message id
     * @return bool Checking result
     */
    public function isUpdatedTable($msgId)
    {
        $sql = "SELECT COUNT(*) FROM messages WHERE message_id > $msgId";
        $statement = $this->conn->query($sql);

        return $statement->fetchColumn() > 0;
    }
}
