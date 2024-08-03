<?php

declare(strict_types=1);

$task = new Task(); //FIXME: Variable name collision
$todoList = $task->getAll();
?>

<div class="list-group list-group-flush">
    <?php
    foreach ($todoList as $todo) {
        $checked = $todo['status'] ? 'checked' : '';
        $strike = $todo['status'] ? 'text-decoration-line-through' : '';
        $action = $todo['status'] ? 'uncompleted' : 'complete';

        echo "<div class='d-flex list-group-item'>";
        echo "<input class='form-check-input me-1' type='checkbox' id='task-{$todo['id']}' $checked>";

        echo "<a href='?{$action}={$todo['id']}' class='w-100 text-decoration-none text-dark'>";
        echo $todo['status'] ? "<del>{$todo['text']}</del>" : $todo['text'];
        echo "<label class='form-check-label $strike' for='task-{$todo['id']}'></label>";
        echo "</a>";

        echo "<a href='?update={$todo['id']}' class='p-2'><button type='button' class='btn btn-success'>Update</button></a>";
        echo "<a href='?delete={$todo['id']}' class='p-2'><button type='button' class='btn btn-danger'>Delete</button><i class='fa-solid fa-trash text-danger'></i></a>";
        echo "</div>";
    }
    ?>

</div>
