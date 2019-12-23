<?php
include_once '/system/php/function/check_profile.php';

check_profile();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>View All Courses</title>

    <link rel="stylesheet" href="/system/css/table.css">
    <link rel="stylesheet" href="/system/css/template.css">
</head>

<body>
    <?php include '/system/html/header.html' ?>

    <div class="content">
        <div class="button-bar">
            <button>
                <a href="/system/php/course/my_course.php">
                    <?php
                    $_SESSION['profile']['role'] == 'student'
                        ? print 'My Courses'
                        : print 'My Added Courses'; ?>
                </a>
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
                <!-- <th>Action 1</th>
                <?php
                if ($_SESSION['profile']['role'] == 'staff')
                    echo "<th>Action 2</th>";
                ?> -->
            </thead>

            <tbody>
                <?php
                require_once '/system/php/function/run_query.php';
                include_once '/system/php/function/sql_cmds.php';

                $sql = fetch_all_courses_cmd();

                $res = get_assoc($sql);

                foreach ($res as $course) {
                    echo "<tr>";
                    foreach ($course as $key => $val)
                        if ($key != 'id' && $key != 'created_by')
                            echo "<td>$val</td>";

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