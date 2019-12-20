<?php
    include_once 'php/function/db_get.php';

    $course_id = htmlentities($_GET['course_id']);
    $stu_id = $_SESSION['profile']['id'];

    $sql = "INSERT INTO student(studentId, courseId) VALUES($stu_id, $course_id);";

    
?>