<?php

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    function check_profile(){
        if(!isset($_SESSION['profile'])) {
            header("location: /system/login.php");
            exit();
        }
    }
?>