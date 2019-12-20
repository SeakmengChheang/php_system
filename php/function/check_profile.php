<?php
    /**
     * Check if user already logged in
     * by checking if $_SESSION exists
     * If user is NOT exist, go to Login Page
     */
    function check_profile(){
        if(!isset($_SESSION['profile'])) {
            header("location: login.php");
        }
    }
?>