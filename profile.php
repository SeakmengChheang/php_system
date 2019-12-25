<script src = "js/confirm.js"></script>
<script src = "js/validate.js"></script>
<?php
    include "php/function/check_profile.php"; 
    check_profile();
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    $data = $_SESSION["profile"];
    include "message.php";
?>

<script>
    function change_option(){
        if(document.getElementById("profile_option").checked){
            document.getElementById("container1-id").innerHTML = 
            `<fieldset class="container" >
            <legend><h1>I N F O R M A T I O N</h1></legend>
            <div class="div1-1">
                <p class="info">Username</p>
                <p class="info">Full Name</p>
                <p class="info">Role </p>    
            </div>
            <div class="div2-1">
                <p class="info">:<?php echo $data["username"]?></p>
                <p class="info">:<?php echo $data["fullName"]?></p>
                <p class="info">:<?php echo $data["role"]?></p>
            </div>
            <button>EDIT</button>
            </fieldset>`;
            document.getElementById("container2-id").innerHTML=
            `<fieldset class="container" >
            <legend><h1>I N F O R M A T I O N</h1></legend>
            <form name = "myform" action="update_info.php" method = "POST" onsubmit = "return validate('myform','full_name','Full Name')">
                <div class="div1-1">
                    <p class="info">Username</p>
                    <p class="info">Full Name</p>
                    <p class="info">Role </p> 
                </div>
                <div class="div2-1">
                    <p>:<?php echo $data["username"]?></p>
                    <p>: <input type="text" placeholder="Full Name" name = "full_name"></p>
                    <p>:<?php echo $data["role"]?></p>
                </div>
                <button type = "submit">UPDATE</button>
            </form>
            </fieldset>`;
            document.getElementById("container3-id").innerHTML="";
            document.getElementById("container4-id").innerHTML="";
        }
        else if(document.getElementById("account_option").checked){
            document.getElementById("container3-id").innerHTML=
            `<fieldset class="container" >
            <legend><h1>ACCOUNT</h1></legend>
            <form name = "myform2" action="change_password.php" method="POST" onsubmit = "return (validate('myform2','old_password','OLD PASSWORD')&&validate('myform2','new_password','NEW PASSWORD')&&validate('myform2','cnew_password','CONFIRM PASSWORD'))">
                <input type="password" name = "old_password" placeholder="OLD PASSWORD"><br>
                <input type="password" name = "new_password" placeholder="NEW PASSWORD"><br>
                <input type="password" name = "cnew_password" placeholder="CONFIRM PASSWORD"><br>
                <button type="submit" ">CHANGE PASSWORD</button>
            </form>
            </fieldset>`;
            document.getElementById("container1-id").innerHTML="";
            document.getElementById("container2-id").innerHTML="";
            document.getElementById("container4-id").innerHTML=""; 
        }
        else if(document.getElementById("deactivate_option").checked){
            document.getElementById("container4-id").innerHTML=
            `<fieldset class="container" >
            <legend><h1>D E A C T I V A T E</h1></legend>
            <form name = "myform1" action="deactivate.php" method="POST" onsubmit = "return (validate('myform1','password','PASSWORD') && con_firm('ARE YOU SURE YOU WANT TO DELETE?') )">
                <input type="password" name = "password" placeholder="PASSWORD"><br>
                <button type="submit">DEACTIVATE</button>
            </form>
            </fieldset>`; 
            document.getElementById("container1-id").innerHTML="";
            document.getElementById("container2-id").innerHTML="";
            document.getElementById("container3-id").innerHTML="";
            
        }

    }

</script>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/template.css">
</head>
<body>
    <?php 
        include "html/header.html"; 
    ?>

    <div class="container1">
        <form onchange="change_option()" action="">
            <label for="profile_option"><input type="radio" name="option" id="profile_option" value="1" checked>Profile</label>
            <label for="account_option"><input type="radio" name="option" id="account_option" value="2">Account</label>
            <label for="deactivate_option"><input type="radio" name="option" id="deactivate_option" value="3">Deactivate</label>
        </form>
    </div>

    <div id="container1-id">
        <fieldset class="container" >
            <legend><h1>I N F O R M A T I O N</h1></legend>
            <div class="div1-1">
                <p class="info">Username</p>
                <p class="info">Full Name</p>
                <p class="info">Role </p>    
            </div>
            <div class="div2-1">
                <p class="info">:<?php echo $data["username"]?></p>
                <p class="info">:<?php echo $data["fullName"]?></p>
                <p class="info">:<?php echo $data["role"]?></p>
            </div>
            <button>EDIT</button>
        </fieldset>
    </div>

    <div id="container2-id">
        <fieldset class="container" >
            <legend><h1>I N F O R M A T I O N</h1></legend>
            <form name = "myform" action="update_info.php" method = "POST" onsubmit = "return validate('myform','full_name','PLEASE FILL IN THE BLANK')">
                <div class="div1-1">
                    <p class="info">Username</p>
                    <p class="info">Full Name</p>
                    <p class="info">Role </p> 
                </div>
                <div class="div2-1">
                    <p>:<?php echo $data["username"]?></p>
                    <p>: <input type="text" placeholder="Full Name" name = "full_name"></p>
                    <p>:<?php echo $data["role"]?></p>
                </div>
                <button type = "submit">UPDATE</button>
            </form>
        </fieldset>
    </div>

    <div id="container3-id">
        <!-- <fieldset class="container" >
            <legend><h1>ACCOUNT</h1></legend>
            <form name = "myform2" action="change_password.php" method="POST" onsubmit = "return (validate('myform2','old_password','PLEASE FILL IN THE BLANK')&&validate('myform2','new_password','PLEASE FILL IN THE BLANK')&&validate('myform2','cnew_password','PLEASE FILL IN THE BLANK'))">
                <input type="password" name = "old_password" placeholder="OLD PASSWORD"><br>
                <input type="password" name = "new_password" placeholder="NEW PASSWORD"><br>
                <input type="password" name = "cnew_password" placeholder="CONFIRM PASSWORD"><br>
                <button type="submit" ">CHANGE PASSWORD</button>
            </form>
        </fieldset> -->
    </div>

    <div id="container4-id">
        <!-- <fieldset class="container" >
            <legend><h1>D E A C T I V A T E</h1></legend>
            <form name = "myform1" action="deactivate.php" method="POST" onsubmit = "return (validate('myform1','password','PLEASE FILL IN THE BLANK') && con_firm('ARE YOU SURE YOU WANT TO DELETE?') )">
                <input type="password" name = "password" placeholder="PASSWORD"><br>
                <button type="submit">DEACTIVATE</button>
            </form>
        </fieldset> -->
    </div>
    <?php include "html/footer.html"; ?>
</body>
</html>