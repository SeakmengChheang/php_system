<?php
include_once "php/function/check_profile.php";

if (session_status() == PHP_SESSION_NONE)
    session_start();

check_profile();

if (isset($_POST['submit'])) {
    if (isset($_SESSION['profile']['role'])) {
        if ($_SESSION['profile']['role'] == 'staff')
            header("location: php/course/add_course.php");
        else
            header("location: php/course/enroll_course.php");
    } else {
        header("location: php/error_page.php");
    }
} else
    header("location: php/course/my_course.php");
