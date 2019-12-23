<?php
include_once '/system/php/function/check_profile.php';
include_once '/system/php/function/check_staff_only.php';
include_once '/system/php/model/course.php';
include_once '/system/php/function/run_query.php';
include_once '/system/php/function/sql_cmds.php';

if (session_status() == PHP_SESSION_NONE)
    session_start();

check_profile();
check_staff_only();

if (isset($_POST["submit"])) {
    $course = new Course();
    $mysqli = open_mysqli();

    if (!Course::set_vals_and_validate($course, $_POST, $mysqli)) {
        $_SESSION['course'] = (array) $course;
        header("location: /system/php/course/form_course.php?action=add");
        $mysqli->close();
        die();
    }

    $sql = add_course_cmd($course);
    if ($mysqli->query($sql)) {
        header("location: /system/course_handler.php");
    } else {
        $_SESSION['course'] = (array) $course;
        echo "<center><h1>Error adding the course</h1> <h3>Redirect back in 5s.</h3></center>";
        sleep(5);
        header("location: /system/php/course/form_course.php?action=add");
    }
}
