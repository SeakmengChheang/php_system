<?php
    session_start();
            
    include "php/function/get_value.php";
    include "php/function/run_query.php";

    $username = get_value("username","POST");
    $password = get_value("password","POST");
    $cpassword = get_value("cpassword","POST");
    $fullname = get_value("fullname","POST");
    $role = get_value("role","POST");
 
    if(strlen($username) > 30){
        $_SESSION["message"] = "USERNAME MUST HAS LESS THAN 30 CHARACTERS";
        header("location: sign_up.php");
    }
    elseif(strlen($password) > 100){
        $_SESSION["message"] = "PASSWORD MUST HAS LESS THAN 100 CHARACTERS";
        header("location: sign_up.php");
    }
    elseif(strlen($fullname) > 100){
        $_SESSION["message"] = "FULL NAME MUST HAS LESS THAN 100 CHARACTERS";
        header("location: sign_up.php");
    }
    elseif($cpassword != $password){
        $_SESSION["message"] = "PASSWORD ARE NOT THE SAME";
        header("location: sign_up.php");
    }
    elseif(preg_match('/[0-9]/', $username[0])){
        $_SESSION["message"] = "USERNAME INVALID \\nPLEASE INPUT CHARACTERS FIRST";
        header("location: sign_up.php");
    }
    elseif(preg_match('/[^a-zA-Z0-9]/', $username)){
        $_SESSION["message"] = "USERNAME INVALID \\nPLEASE INPUT CHARACTERS & NUMBER ONLY";
        header("location: sign_up.php");
    }
    elseif(preg_match('/[^a-zA-Z\s]/', $fullname)){
        $_SESSION["message"] = "FULLNAME INVALID \\nPLEASE INPUT CHARACTERS ONLY";
        header("location: sign_up.php");
    }
    else{
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $data = get_assoc($sql);
        if(count($data) == 0){
            $link = open_db();
            $sql = "INSERT INTO user (username,password,fullName,role) VALUES ('$username','$password','$fullname','$role')";
            $result = mysqli_query($link, $sql);
            $link->close();

            $sql = "SELECT * FROM user WHERE username = '$username'";
            $data = get_assoc($sql);
            $_SESSION["profile"] = $data[0];
            $_SESSION["message"] = "SUCCESSFUL";
            header("location: profile.php");
        }
        else{
            $_SESSION["message"] = "YOUR USERNAME HAS BEEN USED, PLEASE TRY ANOTHER ONE";
            header("location: sign_up.php");
        }
    }
    
    

    
    



    




?>