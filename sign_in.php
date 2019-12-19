<?php
    // session_start();
    include "php/function/db_get.php";
    include "php/function/get_value.php";

    $username = get_value("username" , "POST");
    $password = get_value("password" , "POST");

    if(isset($username) && isset($password)){
        
        $sql = "SELECT * FROM user WHERE username = '$username' && password = '$password' ";

        $data = get_assoc($sql);

        if(count($data) == 1){
            $_SESSION["profile"] = $data;
            header("location: profile.php");
        }
        else{
            $_SESSION["message"] = "WRONG USERNAME OR PASSWORD";
            header("location: login.php");
        }
    }
?>