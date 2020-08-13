<?php

include_once('../database/constants.php');
include_once('user.php');
include_once('DBOperation.php');

// For Registration Processing
if(isset($_POST["username"]) AND isset($_POST["emailAddress"])){
    $user = new User();
    $result = $user->createUserAccount($_POST["username"], $_POST["emailAddress"], $_POST["password"], $_POST["userType"]);
    echo $result;
    exit();
}

// For Login Processing
if(isset($_POST['log_email']) AND isset($_POST['log_pass'])){
    $user = new User();
    $result = $user->userLogin($_POST['log_email'], $_POST['log_pass']);
    echo $result;
    exit();
}

if(isset($_POST['getCategory'])){
    $obj = new DBOperation();
    $rows = $obj->getAllRecord('categories');
    foreach($rows as $row){
        echo "<option vlaue='".$row["cid"]."'>".$row["category_name"]."</option>";
    }
    exit();
}

// Add Category
if(isset($_POST['category_name']) AND isset($_POST['parent_cat'])){
    $obj = new DBOperation();
    $result =$obj->addCategory($_POST['parent_cat'], $_POST['category_name']);
    echo $result;
    exit();
}

// Add Brand

