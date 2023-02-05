<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../db/database.php';
    include_once '../class/task.php';
    include_once '../class/taskAccess.php';
    include_once '../utils/utils.php';
    include_once '../class/projectAccess.php';

    $database = new Database();
    $db = $database->getConnection();
    $taskAccess = new TaskAccess($db);
    $projectAccess = new ProjectAccess($db);

    try {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $uriSegments = Utils::getUriSegments();
            $pathEnd = end($uriSegments);

            if ($pathEnd == "taskControllers.php") {
                $tasks = $taskAccess->getTasks();
            } else if (in_array("project", $uriSegments)) {
                $tasks = $taskAccess->getTasksForProject($pathEnd);
            } else {
                $tasks = $taskAccess->getTask($pathEnd);
            }

            echo json_encode($tasks);
        } 
        else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $body = json_decode(file_get_contents('php://input'));
            $taskRaw = Task::loadFromJson($body);

            if ($projectAccess->exists($taskRaw->project) == false) {
                throw new Exception('Project with id ' . $project . 'does not exist.');
            }
            http_response_code(200); // TODO: Check if this is necessary?
            echo json_encode($taskAccess->createTask($taskRaw));
        }
        else if ($_SERVER["REQUEST_METHOD"] == "PUT") {
            $body = json_decode(file_get_contents('php://input')); 
            $id = Utils::loadIdFromJson($body);
            $oldTask = $taskAccess->getTask($id);
            $newTask = Task::loadPartialTaskFromJson($id, $oldTask, $body);
            $result = $taskAccess->updateTask($newTask);

            echo json_encode($result);
        }
        else if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            $uriSegments = Utils::getUriSegments();
            $taskId = end($uriSegments);
            $resultMessage = $taskAccess->deleteTask($taskId);

            echo json_encode($resultMessage);
        }
    } catch (Exception $e) {
        http_response_code(400);
        $error = new stdClass();
        $error->error = $e->getMessage();
        echo json_encode($error);
    }

?>