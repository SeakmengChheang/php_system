<script src = "js/message.js"></script>
<?php
    session_start();
    $data = $_SESSION["profile"];
?>



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
        include "php/function/check_profile.php"; 
    ?>

    <div class="container1">
        <input type="radio">Profile 
        <input type="radio">Account 
        <input type="radio">Deactivate 
    </div>

    <fieldset class="container">
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

    <fieldset class="container">
        <legend><h1>I N F O R M A T I O N</h1></legend>
        <form action="update_info.php" method = "POST">
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

    <fieldset class="container">
        <legend><h1>ACCOUNT</h1></legend>
        <form action="change_password.php" method="POST">
            <input type="password" name = "old_password" placeholder="OLD PASSWORD"><br>
            <input type="password" name = "new_password" placeholder="NEW PASSWORD"><br>
            <input type="password" name = "cnew_password" placeholder="CONFIRM PASSWORD"><br>
            <button type="submit" ">CHANGE PASSWORD</button>
        </form>
    </fieldset>

    <fieldset class="container">
        <legend><h1>D E A C T I V A T E</h1></legend>
        <form action="deactivate.php" method="POST">
            <input type="password" name = "password" placeholder="OLD PASSWORD"><br>
            <button type="submit">DEACTIVATE</button>
        </form>
    </fieldset>
    <?php include "html/footer.html"; ?>
</body>
</html>