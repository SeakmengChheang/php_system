<script src = "js/message.js"></script>
<?php
    session_start();

    include "php/function/get_value.php";
    include "php/function/run_query.php";

    $data = $_SESSION["profile"];
    
    $oldpassword = get_value("old_password","POST");
    $newpassword = get_value("new_password","POST");
    $cnewpassword = get_value("cnew_password","POST");

    if($oldpassword == $data["password"] && $newpassword == $cnewpassword){
        $username = $data['username'];
        $sql = "UPDATE user SET password = '$newpassword' WHERE username = '$username'";
        run_query($sql);
        $data["password"] = $newpassword;
        $_SESSION["profile"] = $data;
        $_SESSION["message"] = "SUCCESSFUL";
    }
    else{
        $_SESSION["message"] = "WRONG PASSWORD";
    }
    header("location: profile.php");




?>