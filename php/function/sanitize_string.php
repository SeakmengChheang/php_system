<?php 

function sanitize_string($conn, $str) {
	$str = strip_tags($str);
	$str = stripslashes($str);
	return mysqli_real_escape_string($conn, $str);
}

?>