<?php

class DB
{
    public static function connect(): PDO
    {
        return new PDO("mysql:host=localhost;dbname=todo_app", "sobirjon", "4061");
    }
}