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

$mysqli = open_mysqli();

$mysqli->autocommit(FALSE);
$mysqli->begin_transaction();

$mysqli->query($sql_delete_course);
$mysqli->query($sql_delete_course_from_student);

$mysqli->commit();

$mysqli->close();

header("location: ../../course_handler.php");
