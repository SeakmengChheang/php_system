<?php
    include "../../php/function/check_profile.php"; 
    include "../../php/function/run_query.php";
    include "../../php/function/get_value.php";

    check_profile();
    
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    
    $data = $_SESSION["profile"];

    $full_name = get_value("full_name","POST");
    $staff_position = "";
    if($data["role"] == "staff"){
        $staff_position = get_value("staff_position","POST");
    }

    if(strlen($full_name) > 100){
        $_SESSION["message"] = "PLEASE INPUT FULL NAME LESS THAN 100 CHARACTER";
    }
    elseif(preg_match('/[^a-zA-Z\s]/', $full_name)){
        $_SESSION["message"] = "FULLNAME INVALID \\nPLEASE INPUT CHARACTERS ONLY";
    }
    elseif($staff_position != "" && preg_match('/[^a-zA-Z\s]/', $staff_position)){
        if(strlen($staff_position) > 100){
            $_SESSION["message"] = "PLEASE INPUT STAFF POSITION LESS THAN 100 CHARACTER";
        }
        $_SESSION["message"] = "STAFF POSITION INVALID \\nPLEASE INPUT CHARACTERS ONLY";
    }
    else{
        $username = $data["username"];
        $sql = "UPDATE user SET fullName = '$full_name' WHERE username = '$username'";
        run_query($sql);
        if($data["role"] == "staff"){
            $staffid = $data["id"];
            $sql = "UPDATE staff SET position = '$staff_position' WHERE staffId = '$staffid'";
            run_query($sql);
            $data["position"] = $staff_position;
        }
        $_SESSION["message"] = "SCCESSFUL";
        $data["fullName"] = $full_name;
        $_SESSION["profile"] = $data;
    }
    header("location: profile.php");
    exit();
    

?>
