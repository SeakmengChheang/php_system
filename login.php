<?php
    session_start();
    if(isset($_SESSION['profile'])) {
        header("location: index.php");
    } else {
        include "php/function/db_get.php";
        include "php/function/get_value.php";

        if(isset($_POST["username"]) && isset($_POST["password"])){
            
            $username = get_value("username" , "POST");
            $password = get_value("password" , "POST");        

            $sql = "SELECT * FROM user WHERE username = '$username' && password = '$password' ";

            $data = get_assoc($sql);

            if(count($data) == 1){
                $_SESSION["profile"] = $data[0];
                header("location: index.php");
            }
            else{
                $_SESSION["message"] = "WRONG USERNAME OR PASSWORD";
                include "message.php";
            }
        } 
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <fieldset class="box">
            <legend><h1>S I G N I N</h1></legend>

            <form action="login.php" method="POST">
                <div class="logo-container">
                    <img src="images/userlogo.svg" alt="" class="logo">
                </div>
    
                <div class="input-container">
                    <label>
                        <img src="images/user.svg" align="top" alt="" class="icon">
                        <input type="text" class="input" id="inputtext" placeholder="username" name="username">
                    </label>
                </div>
                
                <div class="input-container">
                    <label>
                        <img src="images/lock.svg" align="top" alt="" class="icon">
                        <input type="password" class="input" id="inputpassword" placeholder="password" name="password">
                    </label>
                </div>
    
                <div class="signup-container">
                    <p class="signup-p"><a href="" class="signup-a">Sign Up</a></p>
                </div>
    
                <div class="button-container">
                    <button class="button" type="submit">Sign In</button>
                </div>
            </form>
        </fieldset>
    </div>
</body>
</html>