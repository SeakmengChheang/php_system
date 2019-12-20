<?php
include_once '/system/php/function/run_query.php';

//TODO: For staff

if (session_status() == PHP_SESSION_NONE)
    session_start();

$course_id = htmlentities($_GET['course_id']);
$stu_id = $_SESSION['profile']['id'];

$sql = "DELETE FROM student 
    WHERE student.studentId = $stu_id AND student.courseId = $course_id;";

run_query($sql);

header("location: /system/course_handler.php");
