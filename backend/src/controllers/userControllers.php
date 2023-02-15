<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../db/database.php';
    include_once '../class/user.php';
    include_once '../class/userAccess.php';
    include_once '../utils/utils.php';

    $database = new Database();
    $db = $database->getConnection();
    $userAccess = new UserAccess($db);

    try {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $uriSegments = Utils::getUriSegments();
            $pathEnd = end($uriSegments);

            if ($pathEnd == "userControllers.php") {
                $users = $userAccess->getUsers();
            } else if ($pathEnd == "password") {
                $userId = $uriSegments[count($uriSegments)-2];
                $users = $userAccess->getPasswordForUser($userId);
            } else {
                $users = $userAccess->getUser($pathEnd);
            }

            echo json_encode($users);
        } 
        else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $uriSegments = Utils::getUriSegments();
            $pathEnd = end($uriSegments);

            if ($pathEnd == "userControllers.php") {
                $body = json_decode(file_get_contents('php://input')); 
                
                $userRaw = User::loadFromJson($body);
                $user = $userAccess->createUser($userRaw);

                echo json_encode($user);
            } else {
                $fileName = json_decode(file_get_contents('php://input'));

                $users = $userAccess->createUsersFromImport($fileName);

                echo json_encode($users);
            }
        }
        else if ($_SERVER["REQUEST_METHOD"] == "PUT") {
            $body = json_decode(file_get_contents('php://input')); 
            $id = Utils::loadIdFromJson($body);

            $oldUser = $userAccess->getUser($id);
            $newUser = User::loadPartialUserFromJson($id, $oldUser, $body);
            $result = $userAccess->updateUser($newUser);

            echo json_encode($result);
        }
        else if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            $uriSegments = Utils::getUriSegments();
            $userId = end($uriSegments);
            $resultMessage = $userAccess->deleteUser($userId);

            echo json_encode($resultMessage);
        }
    } catch (Exception $e) {
        http_response_code(400);
        $error = new stdClass();
        $error->error = $e->getMessage();
        echo json_encode($error);
    }
?>