<?php

namespace TodoApp;

use TodoApp\Database;

class Todo
{
    public function __construct()
    {
        $this->database = new Database();
    }

    /**
     * Return All Active TodoList
     */
    public function active_todo()
    {
        $active_todo = $this->database->get("todo", "task_status=1");
        echo json_encode($active_todo);
    }

    /**
     * Return All  TodoList
     */
    public function all_todo()
    {
        $all_todo = $this->database->all("todo");
        echo json_encode($all_todo);
    }

    /**
     * Return Completed  TodoList
     */
    public function completed_todo()
    {
        $all_todo = $this->database->get("todo", "task_status=2");
        echo json_encode($all_todo);
    }

    /**
     * @param $task_id
     */
    public function complete($task_id)
    {
        $mark_as_complete = $this->database->update("todo", "task_status='2'", "id='{$task_id}'");
        echo json_encode($mark_as_complete);
    }

    /**
     *
     */
    public function clear_complete()
    {
        $delete_todo = $this->database->delete("todo", "task_status='2'");
        if ($delete_todo) {
            echo json_encode(200);
        }
    }

    /**
     * @param $data
     */
    public function new_todo($data)
    {
        $new_todo = $this->database->save("todo", "task_name='{$data['task_name']}',task_status=1");
        if ($new_todo) {
            echo json_encode(201);
        }
    }

    /**
     * @param $data
     */
    public function edit_todo($data)
    {
        $task_id = $data['id'];
        $update_todo = $this->database->update("todo", "task_name='{$data['task_name']}'", "id='{$task_id}'");
        if ($update_todo) {
            echo json_encode(201);
        }
    }
}
