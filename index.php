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


    <!-- <div class="body">

    </div> -->


    <?php include 'html/footer.html'; ?>

</body>

</html>