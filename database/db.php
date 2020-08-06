<?php

    class Database{
        private $conn;
        public function connect(){
            include_once("constants.php");
            $this->conn = new Mysqli(HOST,USER,PASS,DB);
            if($this->conn){
                return $this->conn;
            }
            return "DATABASE_CONNECTION_FAIL";
        }
    }

    // $db = new Database();
    // $db->connect();

?>