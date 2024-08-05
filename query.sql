CREATE DATABASE todo_list;

USE todo_list;

CREATE TABLE users (

id INT AUTO_INCREMENT PRIMARY KEY,
chat_id BIGINT,
status VARCHAR(32)
);

CREATE TABLE todos (

id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT,
title VARCHAR(255),
status tinyint(1)
);
