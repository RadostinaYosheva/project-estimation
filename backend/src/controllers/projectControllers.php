<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../db/database.php';
    include_once '../class/project.php';
    include_once '../class/projectAccess.php';
    include_once '../class/taskAccess.php';
    include_once '../utils/utils.php';


    $database = new Database();
    $db = $database->getConnection();
    $projectAccess = new ProjectAccess($db);
    $taskAccess = new TaskAccess($db);

    try {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $uriSegments = Utils::getUriSegments();
            $pathEnd = end($uriSegments);

            if ($pathEnd == "projectControllers.php") {
                $result = $projectAccess->getProjects();
                foreach ($result as $project) {
                    $tasks = $taskAccess->getTasksForProject($project->id);
                    $project->addTasks($tasks);
                }
            } else {
                $result = $projectAccess->getProject($pathEnd);
                $tasks = $taskAccess->getTasksForProject($result->id);
                $result->addTasks($tasks);
            }

            echo json_encode($result);
        } 
        else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $body = json_decode(file_get_contents('php://input')); 
            
            $projectRaw = Project::loadFromJson($body);
            $project = $projectAccess->createProject($projectRaw);

            $tasksForProject = $taskAccess->getTasksForProject($projectRaw->id);

            $project->addTasks($tasksForProject);

            echo json_encode($project);
        }
        else if ($_SERVER["REQUEST_METHOD"] == "PUT") {
            $uriSegments = Utils::getUriSegments();
            $pathEnd = end($uriSegments);

            $body = json_decode(file_get_contents('php://input')); 
            $oldProject = $projectAccess->getProject($pathEnd);
            $newProject = Project::loadPartialProjectFromJson($pathEnd, $oldProject, $body);
            $result = $projectAccess->updateProject($newProject);

            echo json_encode($result);
        }
        else if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            $uriSegments = Utils::getUriSegments();
            $projectId = end($uriSegments);
            $resultMessage = $projectAccess->deleteProject($projectId);

            echo json_encode($resultMessage);
        }
    } catch (Exception $e) {
        http_response_code(400);
        $error = new stdClass();
        $error->error = $e->getMessage();
        echo json_encode($error);
    }

?>