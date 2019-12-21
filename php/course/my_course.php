<?php
include_once '/system/php/function/check_profile.php';

check_profile();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Course</title>

    <link rel="stylesheet" href="/system/css/table.css">
    <link rel="stylesheet" href="/system/css/template.css">
</head>

<body>
    <?php include '/system/html/header.html' ?>

    <div class="content">
        <div class="button-bar">
            <button><?php
                    $_SESSION['profile']['role'] == 'student'
                        ? print 'My Course'
                        : print 'Added Courses'; ?></button>
            <button>View All</button>
        </div>

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
                require_once '/system/php/function/run_query.php';
                include_once '/system/php/function/sql_cmds.php';

                $id = $_SESSION['profile']['id'];
                if ($_SESSION['profile']['role'] == 'student') {
                    //fetch enrolled courses
                    $sql = fetch_student_enrolled_courses_cmd($id);
                } else {
                    //fetch created courses
                    $sql = fetch_staff_created_courses_cmd($id);
                }

                $res = get_assoc($sql);

                foreach ($res as $course) {
                    echo "<tr>";
                    foreach ($course as $key => $val) {
                        if ($key == 'id') {
                            $course_id = $val;
                            continue;
                        } else
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