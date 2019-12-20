<?php
    session_start();
            
    include "php/function/get_value.php";
    include "php/function/run_query.php";

    $username = get_value("username","POST");
    $password = get_value("password","POST");
    $cpassword = get_value("cpassword","POST");
    $fullname = get_value("fullname","POST");
    $role = get_value("role","POST");
    
    if(strlen($username) > 30 || strlen($password) > 100 
    || strlen($fullname) > 100 || $role == "" 
    || $cpassword != $password){
        $_SESSION["message"] = "PLEASE INPUT VALID DATA";
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