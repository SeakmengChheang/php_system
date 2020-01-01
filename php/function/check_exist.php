<?php

function check_exist($field, $keyword, $course_id)
{
	$sql = "SELECT COUNT(*) AS cnt FROM course_view WHERE `$field` = '$keyword'";

	//When add course_id = -1
	if ($course_id != -1)
		$sql .= " AND `id` <> '$course_id'";

	return get_row_assoc($sql)['cnt'] == 0 ? false : true;
}
