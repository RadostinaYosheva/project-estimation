<?php

include_once '../class/task.php';
include_once '../class/project.php';

class ProjectAccess {
    private $connection;
    private $db_table = "Project";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getProjects() {
        $sqlQuery = "SELECT id, title, owner, deadline FROM " . $this->db_table . "";
        $statement = $this->conn->prepare($sqlQuery);
        $statement->execute();

        $projects = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
            $project = Project::loadFromJson((object) $row);

            array_push($projects, $project);
        }
        return $projects;
    }

    public function getProject(string $projectId) {
        $sqlQuery = "SELECT id, title, owner, deadline" .
                    " FROM " . $this->db_table . 
                    " WHERE id =  :projectId";

        $statement = $this->conn->prepare($sqlQuery);
        $statement->bindParam(":projectId", $projectId);
        $statement->execute();

        $tasks = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
            $task = Project::loadFromJson((object) $row);

            array_push($tasks, $task);
        }
        return $tasks;
    }
}

?>