<?php
require_once '../function/check_profile.php';
require_once '../function/check_role.php';
require_once '../model/course.php';
require_once '../function/run_query.php';
require_once '../function/sql_cmds.php';

if (session_status() == PHP_SESSION_NONE)
    session_start();

check_profile();
staff_only_page();

if (isset($_POST["submit"])) {
    $conn = open_db();

    //Since we pass course_id in url para
    $_POST['id'] = $_GET["course_id"];

    sanitize_assoc($conn, $_POST);
    $course = Course::assoc_array_to_obj($_POST);
    unset($_POST);

    if (!Course::validate($course)) {
        $_SESSION['course'] = (array) $course;
        header("location: form_course.php?action=edit&course_id=$course->id");
        mysqli_close($conn);
        die();
    }

    $sql = update_course_cmd($course);
    if (mysqli_query($conn, $sql)) {
        header("location: ../../course_handler.php");
        die();
    } else {
        $_SESSION['course'] = (array) $course;
        header("location: form_course.php?action=edit&course_id=$course->id");
        die();
    }
}
