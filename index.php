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
<<<<<<< HEAD
    <?php
        session_start(); 
        function check_profile(){
            if(!isset($_SESSION['profile'])) {
                header("location: login.php");
            }
        }
        check_profile();
    ?>
=======
>>>>>>> ef3ce4fa27772f4cb99e1ed1824fc02c912ea1c2

    <?php include 'html/header.html'; ?>


    <!-- <div class="body">

    </div> -->


    <?php include 'html/footer.html'; ?>

</body>

</html>