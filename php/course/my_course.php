<?php
include_once '../function/check_profile.php';
include_once '../function/run_query.php';
include_once '../function/sql_cmds.php';
include_once '../helper/enroll_course_helper.php';

if (session_status() == PHP_SESSION_NONE)
    session_start();

check_profile();

$id = $_SESSION['profile']['id'];

//When user searches
if (isset($_GET['keyword']) && isset($_GET["option"])) {
    //Fetch their courses ids whether added courses or enrolled courses
    //To create a range to search in
    if ($_SESSION['profile']['role'] == 'student')
        $sql_cids = fetch_student_enrolled_courseIds_cmd($id);
    else
        $sql_cids = fetch_staff_created_courseIds_cmd($id);

    $c_ids = concat_ids(get_num($sql_cids));
    //

    $option = htmlspecialchars($_GET["option"]);
    $keyword = htmlspecialchars($_GET["keyword"]);
    if ($option == 'all') {
        $sql = search_all_fields($keyword);
    } else
        $sql = search_by_cmd($_GET["keyword"], $_GET["option"]);

    $sql .= " AND id IN ($c_ids)";
    //echo $sql;
}
//In normal view
else {
    if ($_SESSION['profile']['role'] == 'student') {
        //fetch enrolled courses
        $sql = fetch_student_enrolled_courses_cmd($id);
    } else {
        //fetch created courses
        $sql = fetch_staff_created_courses_cmd($id);
    }
}

if(isset($_GET["sort_by"])) {
    $sort_by = htmlspecialchars($_GET["sort_by"]);
    $sql .= " ORDER BY $sort_by";
}
else {
    $sql .= " ORDER BY academic";
}

$res = get_assoc($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Courses</title>

    <script>
        function confirmation(e) {
            if(!confirm('Are you sure?')) {
                e.preventDefault();
            }
        }
    </script>

    <link rel="stylesheet" href="../../css/table.css">
    <link rel="stylesheet" href="../../css/template.css">
</head>

<body>
    <?php include_once '../../html/header.html' ?>

    <div class="content">

        <div class="button-bar">
            <button>
                <a href="view_all.php">View All</a>
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
                        echo "<td><a href=\"form_course.php?action=edit&course_id=$course_id\">Edit</a></td>";

                        $file_name = 'delete_handler';
                        $action_name = 'Delete';
                    }

                    echo "<td><a href=\"$file_name.php?course_id=$course_id\" onclick=\"confirmation()\">$action_name</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <form action="<?php $_SESSION['profile']['role'] == 'student'
                            ? print "enroll_course.php"
                            : print "form_course.php?action=add" ?>" method="POST">
            <button type="submit" name="submit">
                <?php
                if (isset($_SESSION['profile']['role'])) {
                    $_SESSION['profile']['role'] == 'student'
                        ? print "Enroll Course"
                        : print "Add Course";
                } else
                    header("location: ../error_page.php");
                ?>
            </button>
        </form>
    </div>

    <?php include_once '../../html/footer.html' ?>

</body>

</html>