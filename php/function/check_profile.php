<?php
<<<<<<< HEAD
    
    // session_start(); 
=======
    /**
     * Check if user already logged in
     * by checking if $_SESSION exists
     * If user is NOT exist, go to Login Page
     */
>>>>>>> ef3ce4fa27772f4cb99e1ed1824fc02c912ea1c2
    function check_profile(){
        if(!isset($_SESSION['profile'])) {
            header("location: login.php");
        }
    }
    check_profile();


?>