<?php
class Course
{
	public $id;
	public $academic;
	public $semester;
	public $course_name;
	public $course_code;
	public $cg_id;
	public $course_desc;
	public $created_by;

	static function concat_academic($y1, $y2)
	{
		if ($y2 <= $y1)
			return false;

		return $y1 . '-' . $y2;
	}
}
