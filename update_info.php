<?php

    include "php/function/update.php";
    include "php/function/get_value.php";

    $full_name = get_value("full_name","POST");

    if(strlen($full_name) > 100){
        echo ERROR;
    }
    else{
        session_start();
        $data = $_SESSION["profile"];
        $username = $data["username"];
        $sql = "UPDATE user SET fullName = '$full_name' WHERE username = '$username'";
        update($sql);
        header("location: profile.php");
    }

?>
