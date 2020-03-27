<?php

namespace TodoApp;

use mysqli;

class Database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db   = "todo_assignment";
    private $prepare;

    public function __construct()
    {
        $this->connection();
    }

	 /**
	  * Database Connection Established
	  */
    private function connection()
    {
        $this->prepare = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($this->prepare->connect_errno) {
            die("Error");
        }
    }

	 /**
	  * @param $table
	  * @param $values
	  *
	  * @return mixed
	  */
    public function save($table, $values)
    {
        $query   = "INSERT INTO {$table} SET {$values}";
        $insert  = $this->prepare->query($query) or die($this->prepare->error . __LINE__);
        if ($this->prepare->affected_rows > 0) {
            return $insert;
        }
    }

	 /**
	  * @param $table
	  *
	  * @return mixed
	  */
    public function all($table)
    {
        $query = "SELECT * FROM {$table}";
        $select = $this->prepare->query($query) or die($this->prepare->error . __LINE__);
        if ($select->num_rows > 0) {
            return $select->fetch_all(MYSQLI_ASSOC);
        }
    }

	 /**
	  * @param $table
	  * @param $condition
	  *
	  * @return mixed
	  */
    public function get($table, $condition)
    {
        $query = "SELECT * FROM {$table} WHERE {$condition}";
        $select = $this->prepare->query($query) or die($this->prepare->error . __LINE__);
        if ($select->num_rows > 0) {
            return $select->fetch_all(MYSQLI_ASSOC);
        }
    }

	 /**
	  * @param $table
	  * @param $values
	  * @param $condition
	  *
	  * @return mixed
	  */
    public function update($table, $values, $condition)
    {
        $query = "UPDATE {$table} SET {$values} WHERE {$condition}";
        $update = $this->prepare->query($query) or die($this->prepare->error . __LINE__);
        if ($this->prepare->affected_rows > 0) {
            return $update;
        }
    }

	 /**
	  * @param $table
	  * @param $condition
	  *
	  * @return bool
	  */
    public function delete($table, $condition)
    {
        $query = "DELETE FROM {$table} WHERE {$condition}";
        $delete = $this->prepare->query($query) or die($this->prepare->error . __LINE__);
        if ($this->prepare->affected_rows > 0) {
            return $delete;
        } else {
            return false;
        }
    }
}
