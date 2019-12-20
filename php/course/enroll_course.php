<?php
include_once 'php/function/sql_cmds.php';
include_once 'php/function/run_query.php';

function fetch_courseIds($id)
{
    $id = $_SESSION['profile']['id'];
    $sql = fetch_student_enrolled_courseIds_cmd($id);

    $res = get_num($sql);

    return $res;
}

if (session_status() == PHP_SESSION_NONE)
    session_start();

$res = fetch_courseIds($_SESSION['profile']['id']);

$cIds = "";
foreach ($res as $a)
    foreach ($a as $val)
        $cIds .= $val . ',';

$cIds = substr($cIds, 0, -1);

$sql = fetch_student_not_yet_enroll_courses($cIds);

$courses = get_assoc($sql);
?>

<table>
    <thead>
        <th>Academic</th>
        <th>Semester</th>
        <th>Course Name</th>
        <th>Course Code</th>
        <th>Course Group</th>
        <th>Course Description</th>
        <th>Author</th>
        <th>Action</th>
    </thead>

    <tbody>
        <?php
        include_once 'php/function/run_query.php';
        include_once 'php/function/sql_cmds.php';

        if (isset($_SESSION['profile']['role'])) {
            foreach ($courses as $course) {
                echo "<tr>";
                foreach ($course as $key => $val) {
                    if ($key == 'id') {
                        $course_id = $val;
                        continue;
                    } else
                        echo "<td>$val</td>";
                }
                echo "<td><a href=\"php/course/enroll_handler.php?course_id=$course_id\">Enroll</a></td>";
                echo "</tr>";
            }
        } else {
            include_once 'php/error_page.php';
        }


        ?>

    </tbody>
</table>