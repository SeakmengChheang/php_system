<?php
    session_start();
            
    include "../../php/function/get_value.php";
    include "../../php/function/run_query.php";
    include "../../php/function/head_location.php";

    $username = get_value("username","POST");
    $password = get_value("password","POST");
    $cpassword = get_value("cpassword","POST");
    $fullname = get_value("fullname","POST");
    $role = get_value("role","POST");
    $staff_position = "";
    if($role == "staff"){
        $staff_position = get_value("staff_position" , "POST");
    }

    if($username == ""){
        head_location("sign_up.php");
    }
    elseif(strlen($username) > 30){
        $_SESSION["message"] = "USERNAME MUST HAS LESS THAN 30 CHARACTERS";
        head_location("sign_up.php");
    }
    elseif(strlen($password) > 100){
        $_SESSION["message"] = "PASSWORD MUST HAS LESS THAN 100 CHARACTERS";
        head_location("sign_up.php");
    }
    elseif(strlen($fullname) > 100){
        $_SESSION["message"] = "FULL NAME MUST HAS LESS THAN 100 CHARACTERS";
        head_location("sign_up.php");
    }
    elseif(strlen($staff_position) > 100){
        $_SESSION["message"] = "STAFF POSITION MUST HAS LESS THAN 100 CHARACTERS";
        head_location("sign_up.php");
    }
    elseif($cpassword != $password){
        $_SESSION["message"] = "PASSWORD ARE NOT THE SAME";
        head_location("sign_up.php");
    }
    elseif(preg_match('/[0-9]/', $username[0])){
        $_SESSION["message"] = "USERNAME INVALID \\nPLEASE INPUT CHARACTERS FIRST";
        head_location("sign_up.php");
    }
    elseif(preg_match('/[^a-z0-9]/', $username)){
        $_SESSION["message"] = "USERNAME INVALID \\nPLEASE INPUT CHARACTERS (LOWERCASE ONLY) & NUMBER ONLY";
        head_location("sign_up.php");
    }
    elseif(preg_match('/[^a-zA-Z\s]/', $fullname)){
        $_SESSION["message"] = "FULLNAME INVALID \\nPLEASE INPUT CHARACTERS ONLY";
        head_location("sign_up.php");
    }
    elseif($staff_position != "" && preg_match('/[^a-zA-Z\s]/', $staff_position)){
        $_SESSION["message"] = "STAFF POSITION INVALID \\nPLEASE INPUT CHARACTERS ONLY";
        head_location("sign_up.php");
    }
    else{
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $data = get_assoc($sql);
        if(count($data) == 0){
            $sql = "INSERT INTO user (username,password,fullName,role) VALUES ('$username','$password','$fullname','$role')";
            $result = run_query($sql);
            
            
            $sql = "SELECT * FROM user WHERE username = '$username'";
            $data = get_assoc($sql);
            if($role == "staff"){
                $staffid = $data[0]["id"];
                $sql = "INSERT INTO staff (staffid,position) VALUES ('$staffid','$staff_position')";
                $result = run_query($sql);
                $data[0]["position"] = $staff_position;
            }
            $_SESSION["profile"] = $data[0];
            $_SESSION["message"] = "SUCCESSFUL";
            head_location("../../Profile/PHP/profile.php");
        }
        else{
            $_SESSION["message"] = "YOUR USERNAME HAS BEEN USED, PLEASE TRY ANOTHER ONE";
            head_location("sign_up.php");
        }
    }
    
    

    
    



    




?>