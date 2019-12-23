<?php
include_once '/system/php/function/check_profile.php';
include_once '/system/php/function/run_query.php';
include_once '/system/php/function/sql_cmds.php';
include_once '/system/php/helper/enroll_course_helper.php';

if (session_status() == PHP_SESSION_NONE)
    session_start();

check_profile();

$id = $_SESSION['profile']['id'];
if (isset($_GET['keyword']) && isset($_GET["option"])) {
    $sql = search_by_cmd($_GET["keyword"], $_GET["option"]);

    if ($_SESSION['profile']['role'] == 'student')
        $sql_cids = fetch_student_enrolled_courseIds_cmd($id);
    else
        $sql_cids = fetch_staff_created_courseIds_cmd($id);

    $c_ids = concat_ids(get_num($sql_cids));

    $sql .= " AND id IN ($c_ids);";
    echo $sql;

    $res = get_assoc($sql);
} else {
    if ($_SESSION['profile']['role'] == 'student') {
        //fetch enrolled courses
        $sql = fetch_student_enrolled_courses_cmd($id);
    } else {
        //fetch created courses
        $sql = fetch_staff_created_courses_cmd($id);
    }
    
    $res = get_assoc($sql);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Courses</title>

    <link rel="stylesheet" href="/system/css/table.css">
    <link rel="stylesheet" href="/system/css/template.css">
</head>

<body>
    <?php include '/system/html/header.html' ?>

    <div class="content">

        <div class="button-bar">
            <button>
                <a href="/system/php/course/view_all.php">View All</a>
            </button>
        </div>

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
                <th>Action 1</th>
                <?php
                if ($_SESSION['profile']['role'] == 'staff')
                    echo "<th>Action 2</th>";
                ?>
            </thead>

            <tbody>
                <?php
                foreach ($res as $course) {
                    echo "<tr>";
                    foreach ($course as $key => $val) {
                        if ($key == 'id') {
                            $course_id = $val;
                            continue;
                        } else if ($key != 'created_by')
                            echo "<td>$val</td>";
                    }

                    if ($_SESSION['profile']['role'] == 'student') {
                        $file_name = 'unenroll_handler';
                        $action_name = "Unenroll";
                    } else {
                        echo "<td><a href=\"/system/php/course/form_course.php?action=edit&course_id=$course_id\">Edit</a></td>";
                        $file_name = 'delete_handler';
                        $action_name = 'Delete';
                    }

                    echo "<td><a href=\"/system/php/course/$file_name.php?course_id=$course_id\">$action_name</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <form action="/system/php/course/<?php $_SESSION['profile']['role'] == 'student'
                                                ? print "enroll_course.php"
                                                : print "form_course.php?action=add" ?>" method="POST">
            <button type="submit" name="submit">
                <?php
                if (isset($_SESSION['profile']['role'])) {
                    $_SESSION['profile']['role'] == 'student'
                        ? print "Enroll Course"
                        : print "Add Course";
                } else
                    include_once '/system/php/error_page.php';
                ?>
            </button>
        </form>
    </div>

    <?php include '/system/html/footer.html' ?>

</body>

</html>