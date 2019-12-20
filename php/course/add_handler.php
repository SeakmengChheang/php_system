<?php

$path = '/system';

if (session_status() == PHP_SESSION_NONE)
    session_start();

if (isset($_POST["submit"])) {
    include_once $path . '/php/model/course.php';
    include_once $path . '/php/function/run_query.php';
    include_once $path . '/php/function/sql_cmds.php';

    $course = new Course();
    $course->academic = Course::concat_academic($_POST['academic_y1'], $_POST['academic_y2']);
    $course->semester = $_POST['semester'];
    $course->course_name = $_POST['courseName'];
    $course->course_code = $_POST['courseCode'];
    $course->cg_id = $_POST['courseGroupId'];
    $course->course_desc = $_POST['courseDesc'];
    $course->created_by = $_SESSION['profile']['id'];

    $sql = add_course_cmd($course);

    if (run_query($sql)) {
        $header = $path . '/course_handler.php';
        header("location: $header");
    } else {
        $_SESSION['course'] = $course;
        $_SESSION['error_msg'] = "Error Inserting into Database";
        $header = $path . '/php/course/add_course.php';
        header("location: $header");
    }
}
