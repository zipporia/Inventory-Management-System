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
        echo "<option vlaue='".$row["paretn_cat"]."'>".$row["category_name"]."</option>";
    }
    exit();
}