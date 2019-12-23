<?php
include_once '/system/php/function/run_query.php';
include_once '/system/php/function/open_db.php';
include_once '/system/php/function/check_profile.php';
include_once '/system/php/function/check_staff_only.php';

if (session_status() == PHP_SESSION_NONE)
    session_start();

check_profile();
check_staff_only();

$course_id = htmlentities($_GET['course_id']);
$stu_id = $_SESSION['profile']['id'];

$sql_delete_course = "DELETE FROM course WHERE id = $course_id";

$sql_delete_course_from_student = "DELETE FROM student 
    WHERE student.studentId = $stu_id AND student.courseId = $course_id;";

$mysqli = open_mysqli();

$mysqli->autocommit(FALSE);
$mysqli->begin_transaction();

$mysqli->query($sql_delete_course);
$mysqli->query($sql_delete_course_from_student);

$mysqli->commit();

$mysqli->close();

header("location: /system/course_handler.php");
