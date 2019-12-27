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

$conn = open_db();

if (isset($_POST["submit"])) {
    $course = new Course();
    
    if (!Course::set_vals_and_validate($course, $_POST, $conn, 'add')) {
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
