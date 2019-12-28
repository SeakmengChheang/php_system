<?php
include_once '../function/run_query.php';
include_once '../function/open_db.php';
include_once '../function/check_profile.php';
include_once '../function/check_role.php';
require_once '../function/mysqli_real_escape_string.php';

if (session_status() == PHP_SESSION_NONE)
    session_start();

check_profile();
staff_only_page();

$conn = open_db();

$course_id = mysqli_real_escape_string($conn, $_GET['course_id']);

$sql_delete_course = "DELETE FROM course WHERE id = $course_id";

mysqli_query($conn, $sql_delete_course) or die(mysqli_error($conn));

header("location: ../../course_handler.php");
die();
