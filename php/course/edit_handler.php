<?php
include_once '/system/php/function/check_profile.php';
include_once '/system/php/model/course.php';
include_once '/system/php/function/run_query.php';
include_once '/system/php/function/sql_cmds.php';

if (session_status() == PHP_SESSION_NONE)
    session_start();

check_profile();

if (isset($_POST["submit"])) {
    $course = new Course();
    $mysqli = open_mysqli();
    $course->id = $mysqli->real_escape_string($_GET['course_id']);

    if (!Course::set_vals_and_validate($course, $_POST, $mysqli)) {
        $_SESSION['course'] = (array) $course;
        header("location: /system/php/course/form_course.php?action=edit&course_id=$course->id");
        $mysqli->close();
        die();
    }

    $sql = update_course_cmd($course);
    if ($mysqli->query($sql)) {
        header("location: /system/course_handler.php");
    } else {
        $_SESSION['course'] = (array) $course;
        echo "<center><h1>Error updating the course</h1> <h3>Redirect back in 5s.</h3></center>";
        header("location: /system/php/course/form_course.php?action=edit&course_id=$course->id");
    }
}
