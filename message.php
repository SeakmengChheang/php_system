<script src = "js/message.js"></script>

<?php

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    $message = $_SESSION["message"] ?? "";
    if($message != ""){
        echo "<script>output('$message')</script>";
        $_SESSION["message"] = "";
    }

?>