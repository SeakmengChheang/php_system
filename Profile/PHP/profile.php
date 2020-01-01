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
                <div class="div-1">
                    <div class="info"><div class="subdiv-1">Username</div>: <?php echo $data["username"]?></div>
                    <div class="info"><div class="subdiv-1">Full Name</div>: <?php echo $data["fullName"]?></div>
                    <div class="info"><div class="subdiv-1">Role</div>: <?php $data["role"][0] = 'S'; echo $data["role"]; $data["role"][0] = 's';?></div>
                    <?php if($data["role"] == "staff") { echo "<div class='info'><div class='subdiv-1'>Position</div>: ".$data["position"]."</div>"; } ?>
                </div>
                
                <div class="button">
                    <button onclick = "edit_button()" class="button-1">EDIT</button>
                </div>
            </fieldset>`;

    var container1_update = `<fieldset class="container" >
            <legend><h1>I N F O R M A T I O N</h1></legend>
            <form name = "myform" action="update_info.php" method = "POST" onsubmit = "return (validate('myform','full_name','FULL NAME') &&
                                                                                              validate('myform','staff_position','STAFF POSITION'))  ">
                <div class="div-1">
                    <div class="info"><div class="subdiv-1">Username</div><span class="colun-1">:</span> <?php echo $data["username"]?></div>
                    <div class="info"><div class="subdiv-1 inputsubdiv-1">Full Name</div>: <input type="text" placeholder="Full Name" name = "full_name" value = '<?php echo $data["fullName"];?>'></div>
                    <div class="info"><div class="subdiv-1">Role</div><span class="colun-1">:</span> <?php $data["role"][0] = 'S'; echo $data["role"]; $data["role"][0] = 's';?></div>
                    <?php if($data["role"] == "staff") { echo "<div class='info'><div class='subdiv-1 inputsubdiv-1'>Position</div>: <input type='text' name = 'staff_position' value = '".$data["position"]."'></div>"; } ?>
                </div>
                
                <div class="button">
                    <button type = "submit" class="button-1">UPDATE</button>
                </div>
                
            </form>
        </fieldset>`;

    var container2 = `<fieldset class="container" >
            <legend><h1>A C C O U N T</h1></legend>
            <form name = "myform2" action="change_password.php" method="POST" onsubmit = "return (validate('myform2','old_password','OLD PASSWORD')&&validate('myform2','new_password','NEW PASSWORD')&&validate('myform2','cnew_password','CONFIRM PASSWORD'))">
                <input type="password" name = "old_password" placeholder="OLD PASSWORD"><br>
                <input type="password" name = "new_password" placeholder="NEW PASSWORD"><br>
                <input type="password" name = "cnew_password" placeholder="CONFIRM PASSWORD"><br>
                <div class="button">
                    <button type = "submit" class="button-1">CHANGE</button>
                </div>
            </form>
            </fieldset>`;

    var container3 = `<fieldset class="container" >
            <legend><h1>D E A C T I V A T E</h1></legend>
            <form name = "myform1" action="deactivate.php" method="POST" onsubmit = "return (validate('myform1','password','PASSWORD') && con_firm('ARE YOU SURE YOU WANT TO DELETE?') )">
                <input type="password" name = "password" placeholder="PASSWORD"><br>
                <div class="button">
                    <button type = "submit" class="button-1">DEACTIVATE</button>
                </div>
            </form>
            </fieldset>`;

    function change_option(){
        if(document.getElementById("profile_option").checked){
            document.getElementById("container1-id").innerHTML = container1;
            // document.getElementById("container2-id").innerHTML = "";
            // document.getElementById("container3-id").innerHTML = "";
        }
        else if(document.getElementById("account_option").checked){
            document.getElementById("container1-id").innerHTML = container2;
            // document.getElementById("container1-id").innerHTML = "";
            // document.getElementById("container3-id").innerHTML = ""; 
        }
        else if(document.getElementById("deactivate_option").checked){
            document.getElementById("container1-id").innerHTML = container3;
            // document.getElementById("container1-id").innerHTML = "";
            // document.getElementById("container2-id").innerHTML = "";
            
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
            <input type="radio" name = "option" id="profile_option" ><label for="profile_option">Profile</label>
            <input type="radio" name = "option" id="account_option" ><label for="account_option">Account</label>
            <input type="radio" name = "option" id="deactivate_option" ><label for="deactivate_option">Deactivate</label>
        </form>
    </div>

    <div id="container1-id">
    
        <script>document.write(
            <?php 
                $value = $_SESSION["value"] ?? 0;
                if($value == 0){
                    echo "container1";
                }
                elseif($value == 1){
                    echo "container1_update";
                }
                elseif($value == 2){
                    echo "container2";
                }
                elseif($value == 3){
                    echo "container3";
                }
            ?>);
            document.getElementById("<?php 
                $value = $_SESSION["value"] ?? 0;
                if($value == 0){
                    echo "profile_option";
                }
                elseif($value == 1){
                    echo "profile_option";
                }
                elseif($value == 2){
                    echo "account_option";
                }
                elseif($value == 3){
                    echo "deactivate_option";
                }
                $_SESSION["value"] = 0;
            ?>").checked = true;
        </script>
    </div>

    <?php include "../../html/footer.html"; ?>
</body>
</html>