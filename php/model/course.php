<?php
require_once '../function/run_query.php';
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

	static function set_vals_and_validate(Course $course, &$POST, &$conn, $action)
	{
		if (session_status() == PHP_SESSION_NONE)
			session_start();

		$y1 = mysqli_real_escape_string($conn, $POST['academic_y1']);
		$y2 = mysqli_real_escape_string($conn, $POST['academic_y2']);
		$course->academic = $y1 . '-' . $y2;
		if (!(is_numeric($y1) && is_numeric($y2)))
			$_SESSION['e_msg']['academic'] = 'Years need to be in number';
		elseif ($y1 + 1 != $y2)
			$_SESSION['e_msg']['academic'] = 'The start year should be smaller than the next year by only 1 year';

		$course->semester = mysqli_real_escape_string($conn, $POST['semester']);
		if ($course->semester > 8 || $course->semester < 1)
			$_SESSION['e_msg']['semester'] = 'Semester should be in range 1 to 8';

		$course->course_name = mysqli_real_escape_string($conn, $POST['course_name']);
		if (strlen($course->course_name) > 255)
			$_SESSION['e_msg']['course_name'] = 'Course Name should be shorter or equal 255 characters';
		elseif ($action != 'edit') {
			$sql = "SELECT * FROM course_view WHERE `course_name` = '$course->course_name'";
			$res = get_row($sql);

			//There exists that course_name in db
			if (!empty($res))
				$_SESSION["e_msg"]['course_name'] = "Course Name is already exists, try new one.";
		}

		$course->course_code = mysqli_real_escape_string($conn, $POST['course_code']);
		if (strlen($course->course_code) > 20)
			$_SESSION['e_msg']['course_code'] = 'Course Code should be shorter or equal 20 characters';
		elseif ($action != 'edit') {
			$sql = "SELECT * FROM course_view WHERE `course_code` = '$course->course_code'";
			$res = get_row($sql);

			//There exists that course_code in db
			if (!empty($res))
				$_SESSION["e_msg"]['course_code'] = "Course Code is already exists, try new one.";
		}

		$POST['cg_id'] = nl2br($POST['cg_id']);
		$course->cg_id = mysqli_real_escape_string($conn, $POST['cg_id']);
		if ($course->cg_id > 4 || $course->cg_id < 1)
		$_SESSION['e_msg']['cg_id'] = 'Course Group ID should be in range 1 to 4';


		$course->course_desc = mysqli_real_escape_string($conn, $POST['course_desc']);
		if (strlen($course->course_desc) > 65535)
			$_SESSION['e_msg']['course_desc'] = 'Course Code should be shorter or equal to 65,535 characters';

		$course->created_by = $_SESSION['profile']['id'];

		return !isset($_SESSION['e_msg']);
	}
}
