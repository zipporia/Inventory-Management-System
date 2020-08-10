<?php

class DBOperation{

    private $conn;

    function __construct(){
        include_once("../database/db.php");
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function addCategory($parent, $cat){
        $pre_stmt = $this->conn->prepare("INSERT INTO `categories`(`paretn_cat`, `category_name`, `status`) 
        VALUES (?,?,?)");
        $status = 1;
        $pre_stmt->bind_param("isi", $parent, $cat, $status);
        $result = $pre_stmt->execute() or die($this->conn->error);
        if($result){
            return "CATEGORY_ADDED";
        }else{
            return 0;
        }
    }// function add category
} // class DBOperation

//  $opr = new DBOperation();
//   echo $opr->addCategory(1, "Moblie");
