<?php
include_once '/system/php/function/sql_cmds.php';
include_once '/system/php/function/run_query.php';
include_once '/system/php/function/check_profile.php';
include_once '/system/php/helper/enroll_course_helper.php';

check_profile();

$cIds = concat_ids(get_num(fetch_student_enrolled_courseIds_cmd($id)));

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
        <?php include_once '/system/html/search_bar.html'; ?>

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
                        } else if ($key != 'created_by')
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