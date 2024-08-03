<?php

require "DB.php";

class Task
{
    private PDO $pdo;
    public function __construct(){
        $this->pdo =DB::connect();
    }

    public function add(string $todoName){
        $status = false;
        $stmt = $this->pdo->prepare("INSERT INTO todos (text, status) VALUES (:text, :status)");
        $stmt->bindParam(':text', $todoName);
        $stmt->bindParam(':status', $status, PDO::PARAM_BOOL);
        return $stmt->execute();
    }

    public function update(int $id, string $todoName): bool
    {
        $status = true;
        $stmt = $this->pdo->prepare("UPDATE todos SET text = :text WHERE id = :id");
        $stmt->bindParam(':text', $todoName);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
        header("Location: index.php");
        exit();
    }
    public function getAll(){
        return $this->pdo->query("SELECT * FROM todos")->fetchAll();
    }
    public function complete(int $id): bool{
        $status = true;
        $stmt = $this->pdo->prepare("UPDATE todos SET status = :status WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_BOOL);
        return $stmt->execute();
    }
    public function uncompleted(int $id): bool{
        $status = false;
        $stmt = $this->pdo->prepare("UPDATE todos SET status = :status WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_BOOL);
        return $stmt->execute();
    }
    public function delete(int $id): bool{
        $stmt = $this->pdo->prepare("DELETE FROM todos WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}