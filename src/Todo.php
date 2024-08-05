
<?php

class Todo
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = DB::connect();
    }

    public function getTodo(int $todoId)
    {
        $todo  = $this->pdo->prepare("SELECT * FROM todos WHERE id = :todo_id");
        $todo->bindParam(':todo_id', $todoId);
        $todo->execute();
        return $todo->fetch();
    }
    public function getTodos()
    {
        $stmt = $this->pdo->query('SELECT * FROM todos');
        return $stmt->fetchAll();
    }

    public function saveTodo(string $text, int|null $userId = null)
    {
        $save = $this->pdo->prepare('INSERT INTO todos (title, user_id, status) VALUES (:title, :user_id, 0)');
        $save->execute(['title' => $text, 'user_id' => $userId]);
    }

    public function deleteTodo($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM todos WHERE id = ?');
        $stmt->execute([$id]);
    }

    // TG BOT && API
    public function getAllTodosByUser(int $userId)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM todos WHERE user_id = :user_id');
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function toggle(int $todoId)
    {
        $update = $this->pdo->prepare("UPDATE todos SET status = !status WHERE id = :todoId");
        $update->execute(['todoId' => $todoId]);
    }

}
