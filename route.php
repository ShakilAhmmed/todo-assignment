<?php
require "vendor/autoload.php";

use TodoApp\Todo;

if (isset($_REQUEST['page'])) {
    $todo = new Todo();
    switch ($_REQUEST['page']) {
        case "get_active":
            $todo->active_todo();
            break;
        case "get_all":
            $todo->all_todo();
            break;
        case "get_completed":
            $todo->completed_todo();
            break;
        case "new_todo":
            $todo->new_todo($_POST);
            break;
        case "edit_todo":
            $todo->edit_todo($_POST);
            break;
        case "clear_complete":
            $todo->clear_complete();
            break;
        case "complete":
            $todo->complete($_GET['task_id']);
            break;
    }
}
