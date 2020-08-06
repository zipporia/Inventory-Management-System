<?php

    class User{

        private $conn;

        function __constructor(){
            include_once('../database/db.php');
            $db = new Database();
            $this->conn = $db->connect();
            if($this->conn){
                echo "Connected";
            }
        }
    }

$obj = new User();