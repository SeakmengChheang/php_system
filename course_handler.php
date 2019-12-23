<?php
include_once "/system/php/function/check_profile.php";

if (session_status() == PHP_SESSION_NONE)
    session_start();

check_profile();

if (isset($_POST['submit'])) {
    if (isset($_SESSION['profile']['role'])) {
        if ($_SESSION['profile']['role'] == 'staff')
            header("location: /system/php/course/add_course.php");
        else
            header("location: /system/php/course/enroll_course.php");
    } else {
        header("location: /system/php/error_page.php");
    }
} else
    header("location: /system/php/course/my_course.php");
