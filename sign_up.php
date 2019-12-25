<script src = "js/validate.js"></script>
<?php
    include "message.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <form name="myform" action="register.php" method = "POST" onsubmit ="return (validate('myform','username','USERNAME')&&
                                                                                    validate('myform','password','PASSWORD')&&
                                                                                    validate('myform','cpassword','CONFIRM PASSWORD')&&
                                                                                    validate('myform','fullname','FULL NAME')&&
                                                                                    validate('myform','role','ROLE'))">
            <p>username:<input type="text" name="username" ></p>
            <p>password:<input type="password" name = "password" ></p>
            <p>confirm password:<input type="password" name="cpassword" ></p>
            <p>fullname:<input type="text" name="fullname" ></p>
            <p>role:<input type="radio" name = "role" value="student" >Student
            <input type="radio" name = "role" value="staff">Staff</p>
            <button type = "submit">Sign Up</button>
        </form>
    </div>
</body>
</html>