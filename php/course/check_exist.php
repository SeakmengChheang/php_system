<?php
require_once '../function/run_query.php';
require_once '../function/check_exist.php';

$field = $_POST['field'];
$keyword = $_POST['value'];

//If add, then course_id = -1
$course_id = $_POST['course_id'];

echo check_exist($field, $keyword, $course_id);