<script src = "js/message.js"></script>
<?php
    session_start();
    $message = $_SESSION["message"] ?? "";
    if($message != ""){
        echo "<script>output('$message')</script>";
        $_SESSION["message"] = "";
    }
?>