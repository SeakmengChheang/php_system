<script src = "../../js/confirm.js"></script>
<script src = "../../js/validate.js"></script>
<?php
    include "../../php/function/check_profile.php"; 
    include "../../php/function/message.php";

    check_profile();
    
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    $data = $_SESSION["profile"];
?>

<script>

    var container1 = `<fieldset class="container" >
                <legend><h1>I N F O R M A T I O N</h1></legend>
                <div class="div1-1">
                    <p class="info">Username</p>
                    <p class="info">Full Name</p>
                    <p class="info">Role </p>    
                    <?php
                        if($data["role"] == "staff"){
                            echo `<p class="info">`."Staff Position".`</p>`;
                        }
                    ?>
                </div>
                <div class="div2-1">
                    <p class="info">:<?php echo $data["username"]?></p>
                    <p class="info">:<?php echo $data["fullName"]?></p>
                    <p class="info">:<?php $data["role"][0] = 'S'; echo $data["role"]; $data["role"][0] = 's';?></p>
                    <?php
                        if($data["role"] == "staff"){
                            echo `<p class="info">`.":".$data["position"].`</p>`;
                        }
                    ?>
                </div>
                <button onclick = "edit_button()">EDIT</button>
            </fieldset>`;

    var container1_update = `<fieldset class="container" >
            <legend><h1>I N F O R M A T I O N</h1></legend>
            <form name = "myform" action="update_info.php" method = "POST" onsubmit = "return (validate('myform','full_name','FULL NAME') &&
                                                                                              validate('myform','staff_position','STAFF POSITION'))  ">
                <div class="div1-1">
                    <p class="info">Username</p>
                    <p class="info">Full Name</p>
                    <p class="info">Role </p> 
                    <?php
                        if($data["role"] == "staff"){
                            echo `<p class="info">`."Staff Position".`</p>`;
                        }
                    ?> 
                </div>
                <div class="div2-1">
                    <p>:<?php echo $data["username"]?></p>
                    <p>: <input type="text" placeholder="Full Name" name = "full_name" value = '<?php echo $data["fullName"];?>'></p>
                    <p>:<?php $data["role"][0] = 'S'; echo $data["role"]; $data["role"][0] = 's';?></p>
                    <?php
                        if($data["role"] == "staff"){
                            echo `<p>`.":<input type='text' name = 'staff_position' value = '".$data["position"]."'>".`</p>`;
                        }
                    ?>
                </div>
                <button type = "submit">UPDATE</button>
            </form>
        </fieldset>`;

    var container2 = `<fieldset class="container" >
            <legend><h1>ACCOUNT</h1></legend>
            <form name = "myform2" action="change_password.php" method="POST" onsubmit = "return (validate('myform2','old_password','OLD PASSWORD')&&validate('myform2','new_password','NEW PASSWORD')&&validate('myform2','cnew_password','CONFIRM PASSWORD'))">
                <input type="password" name = "old_password" placeholder="OLD PASSWORD"><br>
                <input type="password" name = "new_password" placeholder="NEW PASSWORD"><br>
                <input type="password" name = "cnew_password" placeholder="CONFIRM PASSWORD"><br>
                <button type="submit" ">CHANGE PASSWORD</button>
            </form>
            </fieldset>`;

    var container3 = `<fieldset class="container" >
            <legend><h1>D E A C T I V A T E</h1></legend>
            <form name = "myform1" action="deactivate.php" method="POST" onsubmit = "return (validate('myform1','password','PASSWORD') && con_firm('ARE YOU SURE YOU WANT TO DELETE?') )">
                <input type="password" name = "password" placeholder="PASSWORD"><br>
                <button type="submit">DEACTIVATE</button>
            </form>
            </fieldset>`;

    function change_option(){
        if(document.getElementById("profile_option").checked){
            document.getElementById("container1-id").innerHTML = container1;
            document.getElementById("container2-id").innerHTML = "";
            document.getElementById("container3-id").innerHTML = "";
        }
        else if(document.getElementById("account_option").checked){
            document.getElementById("container2-id").innerHTML = container2;
            document.getElementById("container1-id").innerHTML = "";
            document.getElementById("container3-id").innerHTML = ""; 
        }
        else if(document.getElementById("deactivate_option").checked){
            document.getElementById("container3-id").innerHTML = container3;
            document.getElementById("container1-id").innerHTML = "";
            document.getElementById("container2-id").innerHTML = "";
            
        }

    }

    function edit_button(){
        document.getElementById("container1-id").innerHTML = container1_update;
    }

</script>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="../CSS/profile.css">
    <link rel="stylesheet" href="../../css/template.css">
</head>
<body>
    <?php 
        include "../../html/header.html"; 
    ?>

    <div class="container1">
        <form onchange="change_option()" action="">
            <label for="profile_option"><input type="radio" name="option" id="profile_option" value="1" checked>Profile</label>
            <label for="account_option"><input type="radio" name="option" id="account_option" value="2">Account</label>
            <label for="deactivate_option"><input type="radio" name="option" id="deactivate_option" value="3">Deactivate</label>
        </form>
    </div>

    <div id="container1-id">
        <script>document.write(container1);</script>
    </div>

    <div id="container2-id">
        
    </div>

    <div id="container3-id">
        
    </div>
    <?php include "../../html/footer.html"; ?>
</body>
</html>