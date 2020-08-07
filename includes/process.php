<?php

include_once('../database/constants.php');
include_once('user.php');


if(isset($_POST["username"]) AND isset($_POST["emailAddress"])){
    $user = new User();
    $result = $user->createUserAccount($_POST["username"], $_POST["emailAddress"], $_POST["password"], $_POST["userType"]);
    echo $result;
}