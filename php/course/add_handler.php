<?php
include_once '../function/check_profile.php';
include_once '../function/check_role.php';
include_once '../model/course.php';
include_once '../function/run_query.php';
include_once '../function/sql_cmds.php';

if (session_status() == PHP_SESSION_NONE)
    session_start();

check_profile();
staff_only_page();

if (isset($_POST["submit"])) {
    $course = new Course();
    $link = open_db();
    
    if (!Course::set_vals_and_validate($course, $_POST, $link)) {
        $_SESSION['course'] = (array) $course;
        header("location: form_course.php?action=add");
    }

    $sql = add_course_cmd($course);
    mysqli_query($link, $sql);
    if (mysqli_errno($link) === 0) {
        header("location: ../../course_handler.php");
    } else {
        $_SESSION['course'] = (array) $course;
        echo mysqli_error($link);
        die();
        header("location: form_course.php?action=add");
    }
}
