<?php
include_once '/system/php/function/sql_cmds.php';
include_once '/system/php/function/run_query.php';
include_once '/system/php/function/check_profile.php';

check_profile();

function fetch_courseIds($id)
{
    $id = $_SESSION['profile']['id'];
    $sql = fetch_student_enrolled_courseIds_cmd($id);

    $res = get_num($sql);

    return $res;
}

$res = fetch_courseIds($_SESSION['profile']['id']);

$cIds = "";
foreach ($res as $a)
    foreach ($a as $val)
        $cIds .= $val . ',';

$cIds = substr($cIds, 0, -1);

$sql = fetch_student_not_yet_enroll_courses($cIds);

$courses = get_assoc($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enroll Course</title>

    <link rel="stylesheet" href="/system/css/template.css">
    <link rel="stylesheet" href="/system/css/table.css">
</head>

<body>
    <?php include_once '/system/html/header.html' ?>

    <div class="content">
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
                include_once '/system/php/function/run_query.php';
                include_once '/system/php/function/sql_cmds.php';

                foreach ($courses as $course) {
                    echo "<tr>";
                    foreach ($course as $key => $val) {
                        if ($key == 'id') {
                            $course_id = $val;
                            continue;
                        } else
                            echo "<td>$val</td>";
                    }
                    echo "<td><a href=\"/system/php/course/enroll_handler.php?course_id=$course_id\">Enroll</a></td>";
                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>
    </div>

    <?php include_once '/system/html/footer.html' ?>
</body>

</html>