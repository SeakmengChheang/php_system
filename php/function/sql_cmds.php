<?php
function fetch_student_enrolled_courses_cmd($id)
{
    $sql = "SELECT course_view.* FROM student, course_view WHERE student.studentId = $id AND course_view.id = student.courseId";

    return $sql;
}

function fetch_student_enrolled_courseIds_cmd($id)
{
    $sql = "SELECT courseId AS course_id FROM student WHERE studentId = $id";

    return $sql;
}

function fetch_staff_created_courses_cmd($id)
{
    $sql = "SELECT * FROM course_view WHERE created_by = $id";

    return $sql;
}

function fetch_staff_created_courseIds_cmd($id) {
    $sql = "SELECT id FROM course WHERE createdBy = $id";

    return $sql;
}

function fetch_student_not_yet_enroll_courses($cIds)
{
    $sql = "SELECT * FROM course_view WHERE id NOT IN ($cIds)";

    return $sql;
}

function fetch_all_courses_cmd()
{
    $sql = "SELECT * FROM course_view";

    return $sql;
}

function add_course_cmd($course)
{
    $sql = "INSERT INTO course(`academic`, `semester`, `courseName`, `courseCode`, `cgId`, `courseDescription`, `createdBy`) VALUES('$course->academic', '$course->semester', '$course->course_name', '$course->course_code', '$course->cg_id', '$course->course_desc', '$course->created_by')";

    return $sql;
}

function update_course_cmd(Course $course)
{
    $sql = "UPDATE course SET `academic`='$course->academic',`semester`='$course->semester',`courseName`='$course->course_name',`courseCode`='$course->course_code',`cgId`='$course->cg_id',`courseDescription`='$course->course_desc' WHERE id = '$course->id';";

    return $sql;
}

function fetch_course_cmd($courseId)
{
    $sql = "SELECT c.id, c.academic, c.semester, c.courseName AS course_name,c.courseCode as course_code, c.cgId as cg_id, c.courseDescription AS course_desc FROM course AS c WHERE c.id = '$courseId';";

    return $sql;
}

function search_by_cmd($keyword, $field)
{
    $sql = "SELECT * FROM course_view WHERE `$field` LIKE '%$keyword%'";

    return $sql;
}

function search_all_fields($keyword) {
    $sql = "SELECT * FROM course_view WHERE (`academic` LIKE '%$keyword%'
        OR `semester` LIKE '%$keyword%'
        OR `course_name` LIKE '%$keyword%'
        OR `course_code` LIKE '%$keyword%'
        OR `course_group` LIKE '%$keyword%'
        OR `course_desc` LIKE '%$keyword%'
        OR `author` LIKE '%$keyword%')";

    return $sql;
}