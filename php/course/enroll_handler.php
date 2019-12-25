<?php
    include_once '../function/run_query.php';

    if(session_status() == PHP_SESSION_NONE)
        session_start();

    $course_id = htmlentities($_GET['course_id']);
    $stu_id = $_SESSION['profile']['id'];

    $sql = "INSERT INTO student(studentId, courseId) VALUES($stu_id, $course_id);";
    
    run_query($sql);

    header("location: ../../course_handler.php");
?>