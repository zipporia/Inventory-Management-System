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
            if($result->num_rows > 0){
                return 1;
            }else{
                return 0;
            }
        }

        public function createUserAccount($username, $email, $pass, $usertype){

            if($this->emailExist($email)){
                return "EMAIL_ALREADY_EXISTS";
            }else{
                $pass_hash = password_hash($pass,PASSWORD_BCRYPT,["cost"=>8]);
                $date = date("Y-m-d");
                $notes = "";
                $pre_stmt = $this->conn->prepare("INSERT INTO users (user_name, user_email, user_pwd, user_type, register_date, last_login, notes) 
                VALUES (?,?,?,?,?,?,?)");
                $pre_stmt->bind_param("sssssss",$username, $email, $pass_hash, $usertype, $date, $date, $notes);
                $result = $pre_stmt->execute() or die($this->conn->error);
                
                if($result){
                    return $this->conn->insert_id;
                }else{
                    return "SOME_ERROR";
                }
            }
        }

        public function userLogin($email, $password){
            $pre_stmt = $this->conn->prepare("SELECT user_id, user_name, user_pwd, 	last_login FROM users WHERE user_email = ?");
            $pre_stmt->bind_param("s", $email);
            $pre_stmt->execute() or die($this->conn->error);
            $result = $pre_stmt->get_result();

            if($result->num_rows < 1){
                return "NOT_REGISTERD";
            }else{
                $row = $result->fetch_assoc();
                if(password_verify($password,$row["user_pwd"])){
                    $_SESSION["userid"] = $row["user_id"];
                    $_SESSION["username"] = $row["user_name"];
                    $_SESSION["last_login"] = $row["last_login"];

                    $las_login = date("Y-m-d H:i:s");
                    $pre_stmt = $this->conn->prepare("UPDATE users SET last_login = ? WHERE user_email = ?");
                    $pre_stmt->bind_param("ss",$las_login,$email);
                    $result = $pre_stmt->execute() or die($this->conn->error);
                    if($result){
                        return 1;
                    }else{
                        return 0;
                    }
                }else{
                    return "PASSWORD NOT MATCHED";
                }
            }
        }
    }

$user = new User();
echo $user->createUserAccount("Mark", "mark@gmail.com", "123", "Admin");

echo $user->userLogin("mark@gmail.com", "123");

