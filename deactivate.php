<?php
    include "php/function/get_value.php";
    include "php/function/update.php";

    session_start();

    $password = get_value("password" , "POST");

    $data = $_SESSION["profile"];

    if($password == $data["password"]){
        $username = $data["username"];
        $sql = "DELETE FROM user WHERE username = '$username'";
        update($sql);
        echo "SUCCESSFULLY";
        header("location: login.php");
    }

?>