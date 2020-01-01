<?php 

	function sanitize_assoc($conn, &$arr) {
		foreach($arr as &$val)
			$val = mysqli_real_escape_string($conn, trim($val));
	}

?>