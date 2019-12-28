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
    $course = new Course();
    $conn = open_db();
    $course->id = mysqli_real_escape_string($conn, $_GET['course_id']);

    if (!Course::set_vals_and_validate($course, $_POST, $conn, 'edit')) {
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
        echo "<center><h1>Error updating the course</h1> <h3>Redirect back in 3s.</h3></center>";
        sleep(3000);
        header("location: form_course.php?action=edit&course_id=$course->id");
        die();
    }
}
