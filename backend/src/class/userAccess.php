<?php

include_once '../class/user.php';

class UserAccess {
    private $conn;
    private $db_table = "User";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getUsers() {
        $sqlQuery = "SELECT id, first_name, last_name, password, role, email " .
                    "FROM " . $this->db_table . "";
        $statement = $this->conn->prepare($sqlQuery);
        $statement->execute();

        $users = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
            $user = User::loadFromJson((object) $row);

            array_push($users, $user);
        }
        return $users;
    }

    public function getUser(string $userId) {
        $sqlQuery = "SELECT id, first_name, last_name, password, role, email" .
                    " FROM " . $this->db_table . 
                    " WHERE id =  :userId";

        $statement = $this->conn->prepare($sqlQuery);
        $statement->bindParam(":userId", $userId);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $user = User::loadFromJson((object) $row);
        return $user;
    }

    public function getPasswordForUser(string $userId) {
        $sqlQuery = "SELECT password" .
                    " FROM " . $this->db_table . 
                    " WHERE id =  :userId";

        $statement = $this->conn->prepare($sqlQuery);
        $statement->bindParam(":userId", $userId);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $user = User::loadPassFromJson((object) $row);
        return $user;
    }

    public function createUser(User $user) {
        $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        id = :id,
                        first_name = :first_name, 
                        last_name = :last_name, 
                        password = :password,
                        role = :role,
                        email = :email";

        $email = $user->email ?? NULL;
        
        $statement = $this->conn->prepare($sqlQuery);
        $statement->bindParam(":id", $user->id);
        $statement->bindParam(":first_name", $user->first_name);
        $statement->bindParam(":last_name", $user->last_name);
        $statement->bindParam(":password", $user->password);
        $statement->bindParam(":role", $user->role);
        $statement->bindParam(":email", $email);
    
        $statement->execute();

        return $this->getUser($user->id);
    }

    public function updateUser(User $user) {
        $sqlQuery = "UPDATE " . $this->db_table . 
        " SET
            id = :id,
            first_name = :first_name, 
            last_name = :last_name, 
            password = :password,
            role = :role,
            email = :email
        WHERE id = :id";

        $statement = $this->conn->prepare($sqlQuery);
        $statement->bindParam(":id", $user->id);
        $statement->bindParam(":first_name", $user->first_name);
        $statement->bindParam(":last_name", $user->last_name);
        $statement->bindParam(":password", $user->password);
        $statement->bindParam(":role", $user->role);
        $statement->bindParam(":email", $user->email);
    
        $statement->execute();

        return $this->getUser($user->id);
    }

    public function deleteUser(string $userId) {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = :user";

        $statement = $this->conn->prepare($sqlQuery);
        $statement->bindParam(":user", $userId);
        $statement->execute();

        if ($this->exists($userId) == true) {
            throw new Exception ("Failed to delete user with id: " . $userId);
        }

        return "Successfully deleted user with id: " . $userId;
    }

    public function exists(string $userId) {
        $sqlQuery = "SELECT * FROM ". $this->db_table . " WHERE id = :id";

        $statement = $this->conn->prepare($sqlQuery);
        $statement->bindParam(":id", $userId);
        $statement->execute();

        return $statement->rowCount() > 0;
    }
}

?>