<script src="message.js"></script>

<?php
    session_start();
    include "db_get.php";
    include "function.php";

    $username = get_value("username" , "POST");
    $password = get_value("password" , "POST");
    
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
?>