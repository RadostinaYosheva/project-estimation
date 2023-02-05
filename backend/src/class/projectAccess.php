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
}

?>