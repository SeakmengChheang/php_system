<?php
    include "php/function/get_value.php";
    include "php/function/run_query.php";

    session_start();

    $password = get_value("password" , "POST");

    $data = $_SESSION["profile"];

    if($password == $data["password"]){
        $username = $data["username"];
        $sql = "DELETE FROM user WHERE username = '$username'";
        run_query($sql);
        $_SESSION["message"] = "SUCCESSFUL";
        header("location: login.php");
    }
    else{
        $_SESSION["message"] = "WRONG PASSWORD";
        header("location: profile.php");
    }

?>