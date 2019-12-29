<script src = "../../js/validate2.js"></script>
<?php
    include "../../php/function/message.php";
?>

<script>

function role_change(){
    if(document.getElementById("role_student").checked){
        document.getElementById("role-message").innerHTML = "";
        document.getElementById("role-message").className = "";
    }
    else if(document.getElementById("role_staff").checked){
        document.getElementById("role-message").innerHTML = 
        `<div class="catlogo-container">
            <img src="../Image/fullnamelogo.svg" alt="" class="catlogo">
        </div>
        <input type="text" name = "staff_position" placeholder = "Staff Position">`;
        document.getElementById("role-message").className = "cat"; 
    }
}

</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REGISTER</title>
    <link rel="stylesheet" href="../CSS/sign_up.css">
    <!-- <link rel="stylesheet" href="../CSS/sign_up2.css"> -->
</head>
<body>
    <fieldset>
        <form  name="myform" action="register.php" method = "POST" onsubmit ="return (validate('myform','username','USERNAME')&&
                                                                                    validate('myform','password','PASSWORD')&&
                                                                                    validate('myform','cpassword','CONFIRM PASSWORD')&&
                                                                                    validate('myform','fullname','FULL NAME')&&
                                                                                    validate('myform','role','ROLE')&&
                                                                                    validate('myform','staff_position','STAFF POSITION'))">
            <div class = "pagelogo-container">
                <img src="../Image/sign-up.svg" alt="" class="pagelogo">
            </div>

            <div class = "pagelogo-container">
                <p>Sign Up</p>
            </div>

            <div class="cat">
                <div class="catlogo-container">
                    <img src="../Image/userlogo.svg" alt="" class="catlogo">
                </div>
                    <input type="text" name="username" placeholder="Username">
            </div>
            <div class="cat">
                <div class="catlogo-container">
                    <img src="../Image/passwordlogo.svg" alt="" class="catlogo">
                </div>
                <input type="password" name = "password" placeholder="Password">
            </div>
            <div class="cat">
                <div class="catlogo-container">
                    <img src="../Image/passwordlogo.svg" alt="" class="catlogo">
                </div>
                <input type="password" name="cpassword" placeholder="Confirm Password">
            </div>
            <div class="cat">
                <div class="catlogo-container">
                    <img src="../Image/fullnamelogo.svg" alt="" class="catlogo">
                </div>
                <input type="text" name="fullname" placeholder="Full Name">
            </div>
            
            <div id="role-cat">
                <img src="../Image/rolelogo.svg" alt="" class="catlogo">
            </div>
        
            <div class="rolequote-container">
                <p id="role-quote">role:</p>
            </div>
            
            <div onchange="role_change()" class="roleoption-container">
                <div class="role-option">
                    <input type="radio" name = "role" id = "role_student" value = "student"><label for="role_student">Student</label>
                    <input type="radio" name = "role" id = "role_staff" value = "staff"><label for="role_staff">Staff</label>
                </div>
            </div>

            <div id="role-message">
                    
            </div>
        

            <div class="signup-container">
                <button type = "submit" id="signup-button">REGISTER</button>
            </div>
        </form>
    </fieldset>
</body>
</html>