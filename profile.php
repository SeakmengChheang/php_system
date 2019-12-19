<?php
    session_start();
    $data = $_SESSION["profile"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="CSS/profile.css">
</head>
<body>
    <fieldset class="container1">
        <legend><h1>I N F O R M A T I O N</h1></legend>
        <div class="div1-1">
            <p class="info">Username</p>
            <p class="info">Full Name</p>
            <p class="info">Role </p>    
        </div>
        <div class="div2-1">
            <p class="info"><?php echo $data[0]["username"]?></p>
            <p class="info"><?php echo $data[0]["fullName"]?></p>
            <p class="info"><?php echo $data[0]["role"]?></p>
        </div>
    </fieldset>

    <fieldset class="container2">
        <legend><h1>ACCOUNT</h1></legend>
        <a href="" id = "change_password">CHANGE PASSWORD</a><br>
        <form action="" method="POST">
            <input type="password" name = "old_password" placeholder="OLD PASSWORD"><br>
            <input type="password" name = "new_password" placeholder="NEW PASSWORD"><br>
            <input type="password" name = "cnew_password" placeholder="CONFIRM PASSWORD"><br>
            <button type="submit">CHANGE PASSWORD</button>
        </form>
        <a href="">DEACTIVATE ACCOUNT</a>
    </fieldset>
</body>
</html>