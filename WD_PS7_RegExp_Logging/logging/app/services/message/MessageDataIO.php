<?php

namespace app\services\message;

use app\services\DataIO;
use PDO;

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
     * @param PDO $conn Object for connection to database
     */
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    /**
     * Select data.
     * @param int $lastMsgId Last updated message id
     * @return array Message data
     */
    public function selectData($lastMsgId)
    {
        $sql = 'SELECT m.id, m.time, m.message, u.username
            FROM messages m JOIN users u 
            ON m.user_id = u.id
            WHERE m.id > :lastMsgId
            AND m.time > now() - INTERVAL 1 HOUR';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['lastMsgId' => $lastMsgId]);

        $messages = [];

        foreach ($stmt as $row) {
            $message = [];
            $message['id'] = $row['id'];
            $message['time'] = $row['time'];
            $message['user'] = $row['username'];
            $message['text'] = $row['message'];
            array_push($messages, $message);
        }

        $stmt = null;

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

        $sql = 'INSERT INTO messages (user_id, message)
            SELECT id, :msg
            FROM users
            WHERE username = :user';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user' => $user, 'msg' => $msg]);
        $stmt = null;
    }

    /**
     * Check updating of the message table.
     * @param int $lastMsgId Last updated message id
     * @return bool Checking result
     */
    public function isUpdatedTable($lastMsgId)
    {
        $sql = 'SELECT COUNT(*) FROM messages WHERE id > :lastMsgId';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['lastMsgId' => $lastMsgId]);
        $result = $stmt->fetchColumn() > 0;
        $stmt = null;

        return $result;
    }
}
