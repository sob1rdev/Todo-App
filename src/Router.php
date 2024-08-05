<?php

declare(strict_types=1);

class Router
{
    protected $updates;

    public function __construct()
    {
        $this->updates = json_decode(file_get_contents('php://input'));
    }

    public function getUpdates()
    {
        return $this->updates;
    }

    public function isApiCall()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = explode('/', $uri);
        return array_search('api', $path);
    }

    public function getResourceId(): float|false|int|string
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = explode('/', $uri);
        $resourceId = $path[count($path) - 1];
        return is_numeric($resourceId) ? $resourceId : false;
    }

    public function isTelegramUpdate(): bool
    {
        if (isset($this->updates->update_id)) {
            return true;
        }
        return false;
    }

    public function get($path, $callback): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && parse_url($_SERVER['REQUEST_URI'])['path'] === $path) {
            $callback();
            exit();
        }
    }

    public function post($path, $callback): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === $path) {
            $callback();
            exit();
        }
    }

    public function notFound()
    {
        http_response_code(response_code: 404);
        require 'view/pages/404.php';
        exit();
    }

}