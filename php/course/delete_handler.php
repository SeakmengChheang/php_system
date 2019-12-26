<?php
include_once '../function/run_query.php';
include_once '../function/open_db.php';
include_once '../function/check_profile.php';
include_once '../function/check_role.php';

if (session_status() == PHP_SESSION_NONE)
    session_start();

check_profile();
staff_only_page();

$course_id = htmlspecialchars($_GET['course_id']);

$sql_delete_course = "DELETE FROM course WHERE id = $course_id";

$sql_delete_course_from_student = "DELETE FROM student WHERE courseId = $course_id";

run_query($sql_delete_course);

header("location: ../../course_handler.php");
