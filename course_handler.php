<?php
include_once "/system/php/function/check_profile.php";

if (session_status() == PHP_SESSION_NONE)
    session_start();

check_profile();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Course</title>

    <link rel="stylesheet" href="/system/css/template.css">
    <link rel="stylesheet" href="/system/css/table.css">
</head>

<body>
    <?php include '/system/html/header.html' ?>

    <div class="content">
        <?php
        if (isset($_POST['submit'])) {
            //Clearing the $_POST after using to avoid conflict
            //In add_course and enroll_course which also have form submit
            $_POST = array();

            if (isset($_SESSION['profile']['role'])) {
                if ($_SESSION['profile']['role'] == 'staff')
                    header("location: /system/php/course/add_course.php");
                else
                    include_once '/system/php/course/enroll_course.php';
            } else {
                include_once '/system/php/error_page.php';
            }            
        } else
            include_once '/system/php/course/my_course.php';
        ?>

    </div>

    <?php include '/system/html/footer.html' ?>
</body>

</html>