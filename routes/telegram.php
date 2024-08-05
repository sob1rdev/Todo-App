<?php

declare(strict_types=1);

$user = new User();
$bot = new Bot($_ENV['TOKEN']);
$router = new Router();

$update = $router->getUpdates();
if (isset($update->message)) {
    $message = $update->message->text;
    $chatId = $update->message->chat->id;
    $text = $update->message->text;

    if ($text == '/start') {
        echo "start";
        $bot->startBot($chatId);
        return;
    }
    if ($text === '/add') {
        $bot->addHandler($chatId);
        return;
    }
    if ($text == '/all') {
        $bot->getAllTodos($chatId);
        return;
    }


    if ($user->getStatus($chatId)->status == 'add') {
        $bot->handlerSaveTodo($chatId, $text);
        $user->setStatus($chatId, '');
    }
}
if (isset($update->callback_query)) {
    $callback_query = $update->callback_query;
    $data = $callback_query->data;
    $chatId = $callback_query->message->chat->id;
    $messageId = $callback_query->message->message_id;
    if ($data === 'delete') {
        $bot->chuosetTodo($chatId);
        return;
    }
    if ($user->getStatus($chatId)->status == 'delete'){
        $bot->deletedHandler($chatId, (int)$data);
        $user->setStatus($chatId, '');
    }

    $bot->toggle($chatId, (int)$data);

}