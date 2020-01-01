<?php
include "php/function/check_profile.php";

if (session_status() == PHP_SESSION_NONE)
    session_start();

check_profile();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>

    <link rel="stylesheet" href="css/template.css">
    <link rel="stylesheet" href="css/table.css">
</head>

<body>

    <?php include 'html/header.html'; ?>


    <div class="content">
        <button onclick="javascript:window.location='course_handler.php'">Course</button>
        <button onclick="javascript:window.location='Contact/PHP/contact_handler.php'">Contact</button>
        <button onclick="javascript:window.location='Profile/PHP/profile.php'">Profile</button>
        <button onclick="javascript:window.location='log_out.php'">Log Out</button>
    </div>


    <?php include 'html/footer.html'; ?>

</body>

</html>