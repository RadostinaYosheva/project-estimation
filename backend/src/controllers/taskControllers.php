<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../db/database.php';
    include_once '../class/task.php';
    include_once '../class/taskAccess.php';
    include_once '../utils/utils.php';

    $database = new Database();
    $db = $database->getConnection();
    $taskAccess = new TaskAccess($db);

    try {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $uriSegments = Utils::getUriSegments();
            $pathEnd = end($uriSegments);

            if ($pathEnd == "taskControllers.php") {
                $tasks = $taskAccess->getTasks();
            } else {
                $tasks = $taskAccess->getTask($pathEnd);
            }

            echo json_encode($tasks);
        } 
    } catch (Exception $e) {
        http_response_code(400);
        $error = new stdClass();
        $error->error = $e->getMessage();
        echo json_encode($error);
    }

?>