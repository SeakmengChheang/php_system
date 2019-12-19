<?php
    session_start();

    include "php/function/db_get.php";
    include "php/function/get_value.php";

    $data = $_SESSION["profile"];

    $oldpassword = get_value("old_password","POST");
    $newpassword = get_value("new_password","POST");
    $cnewpassword = get_value("cnew_password","POST");

    if($oldpassword == $data["password"] && $newpassword == $cnewpassword){
        
    }
    else{
        $_SESSION["message"] = "WRONG PASSWORD";
        header("location: profile.php");
    }




?>