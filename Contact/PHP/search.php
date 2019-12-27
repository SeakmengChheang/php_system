<?php
    include "../../php/function/get_value.php";
    include "../../php/function/run_query.php";
    include "../../php/function/check_profile.php";
    include "../../php/function/head_location.php";

    check_profile();

    if (session_status() == PHP_SESSION_NONE)
        session_start();

    $input_search = get_value("input_search","POST");
    $option = get_value("option","POST");

    $profile = $_SESSION["profile"];

    switch($option){
        case 0:
            $_SESSION["search"] = "";
        break;

        case 1:
            $sql = "SELECT * FROM user WHERE fullName LIKE '%$input_search%'";
            if($profile["role"] != "staff"){
                $sql += " && role = 'staff'";
            }
            $datas = get_assoc($sql);
            if(count($datas)==0){
                $_SESSION["message"] = "NOT FOUND";
                $_SESSION["search"] = "";
            }
            else{
                $_SESSION["search"] = $datas;
            }

        break;

        case 2:
            $sql = "SELECT * FROM user WHERE username LIKE '%$input_search%'";
            if($profile["role"] != "staff"){
                $sql += " && role = 'staff'";
            }
            $datas = get_assoc($sql);
            if(count($datas)==0){
                $_SESSION["message"] = "NOT FOUND";
                $_SESSION["search"] = "";
            }
            else{
                $_SESSION["search"] = $datas;
            }
        break;
        
        case 3:
            $sql = "SELECT * FROM user WHERE id LIKE '%$input_search%' || username LIKE '%$input_search%' || fullName LIKE '%$input_search%' || role LIKE '%$input_search%'";
            if($profile["role"] != "staff"){
                $sql += " && role = 'staff'";
            }
            $datas = get_assoc($sql);
            if(count($datas)==0){
                $_SESSION["message"] = "NOT FOUND";
                $_SESSION["search"] = "";
            }
            else{
                $_SESSION["search"] = $datas;
            }
        break;
    }
    head_location("contact_handler.php");

?>