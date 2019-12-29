<?php
require_once '../function/run_query.php';
require_once '../function/sanitize_assoc.php';

class Course
{
	public $id;
	public $academic_y1;
	public $academic_y2;
	public $semester;
	public $course_name;
	public $course_code;
	public $cg_id;
	public $course_desc;
	public $created_by;
	public $author;

	static function assoc_array_to_obj($arr)
	{
		$rtn = new Course();

		if (isset($arr['id']))
			$rtn->id = $arr['id'];
		if (isset($arr['academic'])) {
			$arr['academic_y1'] = explode('-', $arr['academic'])[0];
			$arr['academic_y2'] = explode('-', $arr['academic'])[1];
		}

		$rtn->academic_y1 = $arr['academic_y1'];
		$rtn->academic_y2 = $arr['academic_y2'];
		$rtn->semester = $arr['semester'];
		$rtn->course_name = $arr['course_name'];
		$rtn->course_code = $arr['course_code'];
		$rtn->cg_id = $arr['cg_id'];
		$rtn->course_desc = $arr['course_desc'];

		if (isset($arr['created_by']))
			$rtn->created_by = $arr['created_by'];

		if (isset($arr['author']))
			$rtn->author = $arr['author'];

		return $rtn;
	}

	static function validate(Course $course)
	{
		if (!(is_numeric($course->academic_y1) && is_numeric($course->academic_y2)))
			$_SESSION['e_msg']['academic'] = 'Years need to be in number';
		elseif ($course->academic_y1 + 1 != $course->academic_y2)
			$_SESSION['e_msg']['academic'] = 'The start year should be smaller than the next year by only 1 year';

		if ($course->semester > 8 || $course->semester < 1)
			$_SESSION['e_msg']['semester'] = 'Semester should be in range 1 to 8';

		if (strlen($course->course_name) > 255)
			$_SESSION['e_msg']['course_name'] = 'Course Name should be shorter or equal 255 characters';
		else {
			$sql = "SELECT * FROM course_view WHERE `course_name` = '$course->course_name'";
			$res = get_row_assoc($sql);

			//There exists that course_name in db
			if (!empty($res) and $res['id'] != $course->id)
				$_SESSION["e_msg"]['course_name'] = "Course Name is already exists, try new one.";
		}

		if (strlen($course->course_code) > 20)
			$_SESSION['e_msg']['course_code'] = 'Course Code should be shorter or equal 20 characters';
		else {
			$sql = "SELECT * FROM course_view WHERE `course_code` = '$course->course_code'";
			$res = get_row_assoc($sql);

			//There exists that course_code in db
			if (!empty($res) and $res['id'] != $course->id)
				$_SESSION["e_msg"]['course_code'] = "Course Code is already exists, try new one.";
		}

		if ($course->cg_id > 4 || $course->cg_id < 1)
			$_SESSION['e_msg']['cg_id'] = 'Course Group ID should be in range 1 to 4';

		if (strlen($course->course_desc) > 65535)
			$_SESSION['e_msg']['course_desc'] = 'Course Code should be shorter or equal to 65,535 characters';

		return !isset($_SESSION['e_msg']);
	}
}
