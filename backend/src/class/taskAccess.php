<?php

include_once 'task.php';

class TaskAccess {
    private $connection;
    private $db_table = "Task";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getTasks() {
        $sqlQuery = "SELECT id, title, project, assignee, description, type, story_points FROM " . $this->db_table . "";
        $statement = $this->conn->prepare($sqlQuery);
        $statement->execute();

        $tasks = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
            $task = Task::loadFromJson((object) $row);

            array_push($tasks, $task);
        }
        return $tasks;
    }

    public function getTasksForProject(string $projectId) {
        $sqlQuery = "SELECT id, title, project, assignee, description, type, story_points " .
                    " FROM " . $this->db_table . 
                    " WHERE project =  :projectId";

        $statement = $this->conn->prepare($sqlQuery);
        $statement->bindParam(":projectId", $projectId);
        $statement->execute();

        $tasks = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
            $task = Task::loadFromJson((object) $row);

            array_push($tasks, $task);
        }
        return $tasks;
    }

    public function getTask(string $taskId) {
        $sqlQuery = "SELECT id, title, project, assignee, description, type, story_points " .
                    " FROM " . $this->db_table . 
                    " WHERE id =  :taskId";

        $statement = $this->conn->prepare($sqlQuery);
        $statement->bindParam(":taskId", $taskId);
        $statement->execute();

        $tasks = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
            $task = Task::loadFromJson((object) $row);

            array_push($tasks, $task);
        }
        return $tasks;
    }
}

?>