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

print_r($_SESSION["course"]);

if (isset($_POST["submit"])) {
    $course = new Course();
    $mysqli = open_mysqli();
    
    if (!Course::set_vals_and_validate($course, $_POST, $mysqli, 'add')) {
        $_SESSION['course'] = (array) $course;
        header("location: form_course.php?action=add");
        $mysqli->close();
        print_r($_SESSION["e_msg"]);
        die();
    }

    $sql = add_course_cmd($course);
    $mysqli->query($sql);
    if ($mysqli->errno == 0) {
        header("location: ../../course_handler.php");
    } else {
        $_SESSION['course'] = (array) $course;
        echo mysqli_error($link);
        die();
        header("location: form_course.php?action=add");
    }
}
