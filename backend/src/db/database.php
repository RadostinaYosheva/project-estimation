<?php 
    class Database {
        private $host;
        private $database_name;
        private $username;
        private $password;
        public $conn;
        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }

        public function __construct() {
            $ini = parse_ini_file('../init/config.ini');
            
            $db_name = $ini['db_name'];
            $db_user = $ini['db_user'];
            $db_password = $ini['db_password'];
            $db_host = $ini['db_host'];


            if(is_null($ini) || 
                is_null($db_name) ||
                is_null($db_user) || 
                is_null($db_password) || 
                is_null($db_host)) {
                    throw new Exception("Missing fields in configuration. Got: " . json_encode($ini));
                }
            
            
            $this->database_name = $db_name;
            $this->username = $db_user;
            $this->password = $db_password;
            $this->host = $db_host;
        }
    }  
?>