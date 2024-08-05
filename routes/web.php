<?php

$router = new Router();

$router->get('/', fn() => require 'view/pages/home.php');

$router->get('/todos', fn() => require 'view/pages/todos.php');
$router->post('/todos', function () {
    $todo = new Todo();
    $todo->saveTodo($_POST['title']);
    header('Location: /todos');
});

$router->post('/toggle', function () {
    $todo = new Todo();
    $todo->toggle($_POST['id']);
    header('Location: /todos');
});

$router->get('/delete', function () {
    $todo = new Todo();
    $todo->deleteTodo((int)$_GET['id']);
    header('Location: /todos');
});

$router->get('/notes', fn() => require 'view/pages/notes.php');

$router->get('/login', fn() => require 'view/pages/auth/login.php');
$router->post('/login', fn() => (new User())->login());

$router->get('/logout', fn() => (new User())->logout());

$router->get('/register', fn() => require 'view/pages/auth/register.php');
$router->post('/register', fn() => (new User())->register());

$router->notFound();