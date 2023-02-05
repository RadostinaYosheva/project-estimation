<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../db/database.php';
    include_once '../class/taskAccess.php';

    $database = new Database();
    $db = $database->getConnection();
    $taskAccess = new TaskAccess($db);

    try {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $result = $taskAccess->getEstimations();

            echo json_encode($result);
        } 
    } catch (Exception $e) {
        http_response_code(400);
        $error = new stdClass();
        $error->error = $e->getMessage();
        echo json_encode($error);
    }
?>