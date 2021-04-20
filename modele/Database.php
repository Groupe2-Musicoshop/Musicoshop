<?php
    class Database {
        private $host = "127.0.0.1";
        private $database_name = "musicoshop";
        private $username = "root";
        private $password = "";

        /*private $host = "f80b6byii2vwv8cx.chr7pe7iynqr.eu-west-1.rds.amazonaws.com";
        private $database_name = "eb5ttazpjy6sdthk";
        private $username = "ga45v6n3f1i182fu";
        private $password = "hvrox0jwn17yschv";*/

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
    }  
?>