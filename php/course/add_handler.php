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
    $conn = open_db();

    $_POST['created_by'] = $_SESSION['profile']['id'];
    sanitize_assoc($conn, $_POST);
    $course = Course::assoc_array_to_obj($_POST);
    
    if (!Course::validate($course)) {
        $_SESSION['course'] = (array) $course;
        header("location: form_course.php?action=add");
        $mysqli->close();
        die();
    }

    $sql = add_course_cmd($course);
    mysqli_query($conn, $sql) or die(mysqli_error($conn));

    mysqli_close($conn);
    header("location: ../../course_handler.php");
    die();
}
