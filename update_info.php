<?php
    session_start();
        
    include "php/function/run_query.php";
    include "php/function/get_value.php";

    $full_name = get_value("full_name","POST");

    if(strlen($full_name) > 100){
        $_SESSION["message"] = "PLEASE INPUT FULL NAME LESS THAN 100 CHARACTER";
    }
    else{
        $data = $_SESSION["profile"];
        $username = $data["username"];
        $sql = "UPDATE user SET fullName = '$full_name' WHERE username = '$username'";
        run_query($sql);
        $_SESSION["message"] = "SCCESSFUL";
        $data["fullName"] = $full_name;
        $_SESSION["profile"] = $data;
    }
    header("location: profile.php");
    

?>
