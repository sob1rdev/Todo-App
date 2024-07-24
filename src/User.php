<?php

namespace src;
class User {
    private $pdo;

    public function __construct()
    {
        $this->pdo = DB::connect();
    }

    public function setStatus(int $chat_id, string $status): void
    {
        $sql = "UPDATE users SET status = :status WHERE chat_id = :chat_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':chat_id', $chat_id);
        $stmt->execute();
    }

    public function getUserInfo(int $chatId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE chat_id = :chat_id LIMIT 1");
        $stmt->execute(['chat_id' => $chatId]);
        return $stmt->fetchObject();
    }
}
