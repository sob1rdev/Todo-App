<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

date_default_timezone_set("Asia/Tashkent");

$todo = new Todo();
$todos = $todo->getTodos();


$router = new Router();

if ($router->isApiCall()) {
    require "routes/api.php";
    return;
}

if ($router->isTelegramUpdate()) {
    require "routes/telegram.php";
    return;
}

/* ----- Web part ----- */
require 'routes/web.php';
