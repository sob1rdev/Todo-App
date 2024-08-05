<?php
$path = parse_url($_SERVER['REQUEST_URI'])['path'];

$router = new Router();
$todo = new Todo();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($router->getResourceId()) {
        echo json_encode($todo->getTodo($router->getResourceId()));
        return;
    }
    echo json_encode($todo->getTodos());
    return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $update = $router->getUpdates();
    $todo->saveTodo($update->text, $update->userId);
    return;
}

if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
    $update = $router->getUpdates();
    $todo->toggle($update->todoId);
    echo "Resource " . $router->getResourceId() . " updated";
}