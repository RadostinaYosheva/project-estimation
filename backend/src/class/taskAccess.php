<?php

include_once 'task.php';

class TaskAccess {
    private $conn;
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

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $task = Task::loadFromJson((object) $row);

        return $task;
    }

    public function createTask(Task $task) {
        $sqlQuery = "INSERT INTO " . $this->db_table . 
                    "(id, title, project, assignee, description, type, story_points) 
                    values 
                    (:id, :title, :project, :assignee, :description, :type, :story_points)";

        $assignee = $task->assignee ?? NULL;
        $description = $task->description ?? NULL;
        $story_points = $task->story_points ?? NULL;

        $statement = $this->conn->prepare($sqlQuery);
        $statement->bindParam(":id", $task->id);
        $statement->bindParam(":title", $task->title);
        $statement->bindParam(":project", $task->project);
        $statement->bindParam(":assignee", $assignee);
        $statement->bindParam(":description", $description);
        $statement->bindParam(":type", $task->type);
        $statement->bindParam(":story_points", $story_points);

        $statement->execute();

        return $this->getTask($task->id);
    }

    public function updateTask(Task $task) {
        $sqlQuery = "UPDATE " . $this->db_table . 
        " SET title = :title, project = :project, assignee = :assignee, description = :description, type = :type, story_points = :story_points
        WHERE id = :id";

        $statement = $this->conn->prepare($sqlQuery);
        $statement->bindParam(":id", $task->id);
        $statement->bindParam(":title", $task->title);
        $statement->bindParam(":project", $task->project);
        $statement->bindParam(":assignee", $task->assignee);
        $statement->bindParam(":description", $task->description);
        $statement->bindParam(":type", $task->type);
        $statement->bindParam(":story_points", $task->story_points);
    
        $statement->execute();

        return $this->getTask($task->id);
    }

    public function deleteTask(string $taskId) {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = :taskId";

        $statement = $this->conn->prepare($sqlQuery);
        $statement->bindParam(":taskId", $taskId);
        $statement->execute();

        return "Successfully deleted task with id: " . $taskId;
    }

    public function getEstimations() {
        $sqlQuery = "SELECT story_points FROM " . $this->db_table . " WHERE story_points IS NOT NULL";
        $statement = $this->conn->prepare($sqlQuery);
        $statement->execute();

        $estimations = array();
        while ($story_points = $statement->fetch(PDO::FETCH_ASSOC)){

            array_push($estimations, $story_points);
        }
        return $estimations;
    }
}

?>