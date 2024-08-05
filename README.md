# Todo App

This is a simple Todo application built with PHP, MySQL, and HTML/CSS. It allows users to add, update, and delete tasks. The application uses PDO for database interactions.

## Features

- Add new tasks
- Update existing tasks
- Delete tasks
- Mark tasks as completed

## Installation

### Prerequisites

- PHP 7.4 or higher
- MySQL
- Web server (e.g., Apache, Nginx)

### Steps

1. Clone the repository:

    ```bash
    git clone https://github.com/sob1rdev/todo-app.git
    ```

2. Navigate to the project directory:

    ```bash
    cd todo-app
    ```

3. Import the database:

    - Create a database named `todo_app`.
    - Import the `database.sql` file located in the `src` folder into your MySQL database.

4. Update the database configuration:

    - Open `config.php` in the `src` folder.
    - Update the database connection settings with your MySQL credentials.

    ```php
    <?php
    $host = 'your_host';
    $db   = 'todo_app';
    $user = 'your_username';
    $pass = 'your_password';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    ?>
    ```

5. Start your web server and open the application in your browser.

## Usage

- **Add Task**: Use the input field to add a new task.
- **Update Task**: Click on the task text to edit it.
- **Delete Task**: Click the delete button next to the task to remove it.
- **Mark as Completed**: Click the checkbox next to the task to mark it as completed.

## Folder Structure


## Files Description

- `src/add_note.php`: Handles adding new tasks to the database.
- `src/config.php`: Contains database configuration settings.
- `src/delete_note.php`: Handles deleting tasks from the database.
- `src/update_note.php`: Handles updating existing tasks in the database.
- `src/home.php`: The main page that displays the tasks.
- `src/index.php`: The entry point of the application.
- `src/Notes.php`: Contains the `Notes` class with methods for adding, updating, and deleting tasks.
- `src/DB.php`: Contains the `DB` class for creating a PDO connection.
- `src/styles.css`: Contains the CSS styles for the application.
- `database.sql`: SQL file to set up the `todo_app` database.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
