<script src = "../../js/validate2.js"></script>
<?php
    include "../../php/function/message.php";
?>

<script>

function role_change(){
    if(document.getElementById("role_student").checked){
        document.getElementById("role_message").innerHTML = "";
    }
    else if(document.getElementById("role_staff").checked){
        document.getElementById("role_message").innerHTML = `Staff Position:<input type="text" name = "staff_position">`;
    }
}

</script>

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
        <form  name="myform" action="register.php" method = "POST" onsubmit ="return (validate('myform','username','USERNAME')&&
                                                                                    validate('myform','password','PASSWORD')&&
                                                                                    validate('myform','cpassword','CONFIRM PASSWORD')&&
                                                                                    validate('myform','fullname','FULL NAME')&&
                                                                                    validate('myform','role','ROLE')&&
                                                                                    validate('myform','staff_position','STAFF POSITION'))">
            <p>username:<input type="text" name="username" ></p>
            <p>password:<input type="password" name = "password" ></p>
            <p>confirm password:<input type="password" name="cpassword" ></p>
            <p>fullname:<input type="text" name="fullname" ></p>
            <p>role:</p>
            <a onchange="role_change()">
                <label for="role_student"><input type="radio" name = "role" id = "role_student" value = "student">Student</label>
                <label for="role_staff"><input type="radio" name = "role" id = "role_staff" value = "staff">Staff</label>
            </a>
            <p id="role_message"></p>
            <button type = "submit">Sign Up</button>
        </form>
    </div>
</body>
</html>