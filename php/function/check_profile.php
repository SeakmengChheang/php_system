<?php
    
    // session_start(); 
    function check_profile(){
        if(!isset($_SESSION['profile'])) {
            header("location: login.php");
        }
    }
    check_profile();


?>