<?php
function fetch_student_enrolled_courses_cmd($id)
{
    $sql = "SELECT c.academic, c.semester, c.courseName, c.courseCode, 
                    cg.name AS courseGroup, c.courseDescription, 
                    user.fullName AS createdBy FROM student 
                    INNER JOIN course AS c ON c.id = student.courseId
                    INNER JOIN course_group AS cg ON c.cgId = cg.id
                    INNER JOIN user ON c.createdBy = user.id
                    WHERE student.studentId = $id;";

    return $sql;
}

function fetch_student_enrolled_courseIds_cmd($id)
{
    $sql = "SELECT courseId FROM student WHERE studentId = $id";
    return $sql;
}

function fetch_staff_created_courses_cmd($id)
{
    $sql = "SELECT c.academic, c.semester, c.courseName,
        c.courseCode, cg.name AS courseGroup, c.courseDescription,
        user.fullName AS createdBy FROM course AS c
        INNER JOIN course_group cg ON c.cgId = cg.id
        INNER JOIN user ON c.createdBy = user.id
        WHERE createdBy = $id;";
    return $sql;
}

function fetch_student_not_yet_enroll_courses($cIds) {
    $sql = "SELECT c.id, c.academic, c.semester, c.courseName,
    c.courseCode, cg.name AS courseGroup, c.courseDescription,
    user.fullName AS createdBy FROM course AS c
    INNER JOIN course_group cg ON c.cgId = cg.id
    INNER JOIN user ON c.createdBy = user.id 
    WHERE c.id NOT IN ($cIds)";
    return $sql;
}