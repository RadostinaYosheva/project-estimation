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

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $project = Project::loadFromJson((object) $row);
        return $project;
    }

    public function createProject(Project $project) {
        $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        id = :id,
                        title = :title, 
                        deadline = :deadline, 
                        owner = :owner";

        $owner = $project->owner ?? NULL;
        
        $statement = $this->conn->prepare($sqlQuery);
        $statement->bindParam(":id", $project->id);
        $statement->bindParam(":title", $project->title);
        $statement->bindParam(":deadline", $project->deadline);
        $statement->bindParam(":owner", $owner);
    
        $statement->execute();

        return $this->getProject($project->id);
    }

    public function updateProject(Project $project) {
        $sqlQuery = "UPDATE " . $this->db_table . 
        " SET title = :title, owner = :owner, deadline = :deadline
        WHERE id = :id";

        $statement = $this->conn->prepare($sqlQuery);
        $statement->bindParam(":id", $project->id);
        $statement->bindParam(":title", $project->title);
        $statement->bindParam(":deadline", $project->deadline);
        $statement->bindParam(":owner", $project->owner);
    
        $statement->execute();

        return $this->getProject($project->id);
    }

    public function deleteProject(string $projectId) {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = :projectId";

        $statement = $this->conn->prepare($sqlQuery);
        $statement->bindParam(":projectId", $projectId);
        $statement->execute();

        if ($this->exists($projectId) == true) {
            throw new Exception ("Failed to delete project with id: " . $projectId);
        }

        return "Successfully deleted project with id: " . $projectId;
    }

    public function exists(string $projectId) {
        $sqlQuery = "SELECT * FROM ". $this->db_table . " WHERE id = :id";

        $statement = $this->conn->prepare($sqlQuery);
        $statement->bindParam(":id", $projectId);
        $statement->execute();

        return $statement->rowCount() > 0;
    }
}

?>