<?php
    

    function check_profile(){
        session_start();
        if(!isset($_SESSION['profile'])) {
            header("location: login.php");
        }
    }

?>