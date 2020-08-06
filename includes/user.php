<?php

    class User{

        private $conn;

        function __construct(){
            include_once('../database/db.php');
            $db = new Database();
            $this->conn = $db->connect();

        }

        private function emailExist($email){
            $pre_stmt = $this->conn->prepare("SELECT user_id FROM users WHERE user_email=? ");
            $pre_stmt->bind_param("s",$email);
            $pre_stmt->execute() or die($this->conn->error);
            $result = $pre_stmt->get_result();
            if($result > 0){
                return 1;
            }else{
                return 0;
            }
        }

        public function createUserAccount($username, $email, $pass, $usertype){
            $pre_stmt = $this->conn->prepare("");
        }
    }

