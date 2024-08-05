<?php

class User extends DB
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DB::connect();
    }

    public function saveUser(int $chatId)
    {
        $check_user = $this->pdo->prepare("SELECT * FROM `users` WHERE `chat_id` = :chat_id");
        $check_user->bindParam(':chat_id', $chatId);
        $check_user->execute();
        if (!$check_user->fetch()) {
            $save_user = $this->pdo->prepare("INSERT INTO users (chat_id) VALUES (:chat_id)");
            $save_user->bindParam(':chat_id', $chatId, PDO::PARAM_INT);
            $save_user->execute();
        }
    }

    public function setStatus(int $chatId, string $status)
    {
        $update = $this->pdo->prepare("UPDATE `users` SET `status` = :status WHERE `chat_id` = :chat_id");
        $update->bindParam(':status', $status);
        $update->bindParam(':chat_id', $chatId);
        $update->execute();
    }

    public function getStatus(int $chatId)
    {
        $status = $this->pdo->prepare("SELECT * FROM `users` WHERE `chat_id` = :chat_id");
        $status->bindParam(':chat_id', $chatId);
        $status->execute();
        return $status->fetch(PDO::FETCH_OBJ);
    }

    public function getUserInfo(int $chatId)
    {
        $user = $this->pdo->prepare("SELECT * FROM `users` WHERE `chat_id` = :chat_id");
        $user->bindParam(':chat_id', $chatId);
        $user->execute();
        return $user->fetch(PDO::FETCH_OBJ);
    }


    // **************** Bu yerda registratsiya uchun kodlar yozilgan ****************

    public function login(): void
    {
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];

        $stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE `email` = :email AND `password` = :password");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['user'] = $user['email'];
            header("Location: /");
            exit();
        } else {
            $_SESSION["login_error"] = 'Email or password is incorrect';
            header("Location: /login");
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: /");
        exit();
    }

    public function register()
    {
        if ($this->isUserExists()) {
            echo "User already exists";
            return;
        }

        $user = $this->create();
        if ($user) {
            $_SESSION['user'] = $user['email'];
            header("Location: /");
            exit();
        } else {
            $_SESSION["login_error"] = 'User already exists';
            header("Location: /register");
        }
    }

    public function isUserExists(): bool
    {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE `email` = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return (bool)$stmt->fetch();
        }
        return false;
    }

    public function create()
    {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $stmt = $this->pdo->prepare("INSERT INTO `users` (`email`, `password`) VALUES (:email, :password)");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            //Fetch last created user
            $stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE `email` = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }


}
