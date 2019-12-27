<?php
require_once '../function/run_query.php';
require_once '../function/sanitize_string.php';
require_once '../function/check_role.php';
require_once '../function/sql_cmds.php';

if (session_status() == PHP_SESSION_NONE)
    session_start();

student_only_page();

$conn = open_db();

$course_id = sanitize_string($conn, $_GET['course_id']);
$stu_id = $_SESSION['profile']['id'];

$sql = unenroll_course_cmd($stu_id, $course_id);

mysqli_query($conn, $sql) or die(mysqli_error($conn));

mysqli_close($conn);

header("location: ../../course_handler.php");
