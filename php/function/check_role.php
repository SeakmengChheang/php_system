<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

function staff_only_page() {
    if($_SESSION['profile']['role'] != 'staff')
        header("location: ../../index.php");
}

function student_only_page() {
    if($_SESSION['profile']['role'] != 'student')
        header("location: ../../index.php");
}