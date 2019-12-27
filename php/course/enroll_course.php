<?php
require_once '../function/sql_cmds.php';
require_once '../function/run_query.php';
require_once '../function/check_profile.php';
require_once '../helper/enroll_course_helper.php';
require_once '../function/check_role.php';
require_once '../function/sanitize_string.php';

check_profile();
student_only_page();

$conn = open_db();
$str_c_ids = concat_ids(get_num(fetch_student_enrolled_courseIds_cmd($_SESSION["profile"]["id"])));
//Fetch the id of enrolled courses
//When user searches
if (isset($_GET['keyword']) && isset($_GET["option"])) {
    $option = sanitize_string($conn, $_GET["option"]);
    $keyword = sanitize_string($conn, $_GET["keyword"]);
    if ($option == 'all') {
        $sql = search_all_fields($keyword);
    } else
        $sql = search_by_cmd($keyword, $option);

    if ($str_c_ids != '')
        $sql .= " AND id NOT IN ($str_c_ids)";
}
//In normal view
else {
    $sql = fetch_student_not_yet_enroll_courses($str_c_ids);
}

if (isset($_GET["sort_by"])) {
    $sort_by = sanitize_string($conn, $_GET["sort_by"]);
    $sql .= " ORDER BY $sort_by";
} else {
    $sql .= " ORDER BY academic";
}

if (isset($_GET["sort_by_order"]))
    $sort_by_order = sanitize_string($conn, $_GET["sort_by_order"]);
else
    $sort_by_order = 'ASC';
$sql .= ' ' . $sort_by_order;

$courses = mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);

if(mysqli_errno($conn) != 0)
    die(mysqli_error($conn));
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