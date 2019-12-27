<?php

    include "../../php/function/check_profile.php"; 
    include "../../php/function/get_value.php";
    include "../../php/function/run_query.php";
    include "../../php/function/head_location.php";

    check_profile();

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    
    $password = get_value("password" , "POST");

    $data = $_SESSION["profile"];

    if($password == $data["password"]){
        $username = $data["username"];
        $sql = "DELETE FROM user WHERE username = '$username'";
        run_query($sql);
        $_SESSION["message"] = "SUCCESSFUL";
        head_location("../../login.php");
    }
    else{
        $_SESSION["message"] = "WRONG PASSWORD";
        head_location("profile.php");
    }

?>