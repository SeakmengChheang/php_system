<?php
include_once '../function/sql_cmds.php';
include_once '../function/run_query.php';
include_once '../function/check_profile.php';
include_once '../helper/enroll_course_helper.php';
include_once '../function/check_role.php';

check_profile();
student_only_page();

//Fetch the id of enrolled courses
$c_ids = concat_ids(get_num(fetch_student_enrolled_courseIds_cmd($_SESSION["profile"]["id"])));

//When user searches
if (isset($_GET['keyword']) && isset($_GET["option"])) {
    $option = htmlspecialchars($_GET["option"]);
    $keyword = htmlspecialchars($_GET["keyword"]);
    if ($option == 'all') {
        $sql = search_all_fields($keyword);
    } else
        $sql = search_by_cmd($_GET["keyword"], $_GET["option"]);

    $sql .= " AND id NOT IN ($c_ids);";

} 
//In normal view
else {
    $sql = fetch_student_not_yet_enroll_courses($c_ids);
}
//echo $sql;

$courses = get_assoc($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enroll Course</title>

    <link rel="stylesheet" href="../../css/template.css">
    <link rel="stylesheet" href="../../css/table.css">
</head>

<body>
    <?php include_once '../../html/header.html' ?>

    <div class="content">
        <div class="button-bar">
            <button>
                <a href="my_course.php">
                    <?php
                    $_SESSION['profile']['role'] == 'student'
                        ? print 'My Courses'
                        : print 'My Added Courses'; ?>
                </a>
            </button>
        </div>

        <?php include_once 'search_bar.php'; ?>

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
                foreach ($courses as $course) {
                    echo "<tr>";
                    foreach ($course as $key => $val) {
                        if ($key == 'id') {
                            $course_id = $val;
                            continue;
                        } else if ($key != 'created_by')
                            echo "<td>$val</td>";
                    }
                    echo "<td><a href=\"enroll_handler.php?course_id=$course_id\">Enroll</a></td>";
                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>
    </div>

    <?php include_once '../../html/footer.html' ?>
</body>

</html>