<script src = "js/message.js"></script>
<?php
    session_start();

    include "php/function/get_value.php";
    include "php/function/update.php";

    $data = $_SESSION["profile"];
    
    $oldpassword = get_value("old_password","POST");
    $newpassword = get_value("new_password","POST");
    $cnewpassword = get_value("cnew_password","POST");

    if($oldpassword == $data["password"] && $newpassword == $cnewpassword){
        $username = $data['username'];
        $sql = "UPDATE user SET password = '$newpassword' WHERE username = '$username'";
        update($sql);
        $data["password"] = $newpassword;
        $_SESSION["profile"] = $data;
        echo "<script>output('SUCCESSFUL')</script>";
    }
    else{
        echo "<script>output('WRONG PASSWORD')</script>";
    }
    header("location: profile.php");




?>