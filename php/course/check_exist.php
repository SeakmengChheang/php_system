<?php
require_once '../function/run_query.php';

$field = $_POST['field'];
$keyword = $_POST['value'];

//If add, then course_id = -1
$course_id = $_POST['course_id']; 

unset($_POST);

$sql = "SELECT id FROM course_view WHERE `$field` = '$keyword';";
$res = get_row_assoc($sql);

if(!empty($res) AND $res['id'] != $course_id)
	echo true;
else
	echo false;