<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();
?>

<div class="button-bar">
    <button><?php if (isset($_SESSION['profile']['role']))
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
        <th>Action</th>
    </thead>

    <tbody>
        <?php
        require_once 'php/function/run_query.php';
        include_once 'php/function/sql_cmds.php';

        if (isset($_SESSION['profile']['role'])) {
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
                //TODO: Change it
                echo "<td><a href=\"php/course/unenroll_handler.php?course_id=$course_id\">Unenroll</a></td>";
                echo "</tr>";
            }
        } else {
            include_once 'php/error_page.php';
        }
        ?>
    </tbody>
</table>

<form action="" method="POST">
    <button type="submit" name="submit" onclick="window.location='course_handler.php'">
        <?php
        if (isset($_SESSION['profile']['role'])) {
            if ($_SESSION['profile']['role'] == 'staff') {
                echo "Add Course";
            } else {
                echo "Enroll Course";
            }
        } else
            include_once 'php/error_page.php';
        ?>
    </button>
</form>