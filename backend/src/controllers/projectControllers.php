<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../db/database.php';
    include_once '../class/project.php';
    include_once '../class/projectAccess.php';
    include_once '../class/taskAccess.php';


    $database = new Database();
    $db = $database->getConnection();
    $projectAccess = new ProjectAccess($db);
    $taskAccess = new TaskAccess($db);

    try {
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $projects = $projectAccess->getProjects();
            foreach ($projects as $project) {
                $tasks = $taskAccess->getTasksForProject($project->id);
                $project->addTasks($tasks);
            }
            
            echo json_encode($projects);
        }
    } catch (Exception $e) {
        http_response_code(400);
        $error = new stdClass();
        $error->error = $e->getMessage();
        echo json_encode($error);
    }

?>