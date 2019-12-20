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
        <th>Action 1</th>
        <?php
        if($_SESSION['profile']['role'] == 'staff')
            echo "<th>Action 2</th>";
        ?>
    </thead>

    <tbody>
        <?php
        require_once '/system/php/function/run_query.php';
        include_once '/system/php/function/sql_cmds.php';

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
                if($_SESSION['profile']['role'] == 'student') {
                    $file_name = 'unenroll_handler';
                    $action_name = "Unenroll";
                }
                else {
                    echo "<td>Edit</td>";
                    $file_name = 'delete_handler';
                    $action_name = 'Delete';
                }
                
                echo "<td><a href=\"/system/php/course/$file_name.php?course_id=$course_id\">$action_name</a></td>";
                echo "</tr>";
            }
        } else {
            include_once '/system/php/error_page.php';
        }
        ?>
    </tbody>
</table>

<form action="" method="POST">
    <button type="submit" name="submit" onclick="window.location='/system/course_handler.php'">
        <?php
        if (isset($_SESSION['profile']['role'])) {
            if ($_SESSION['profile']['role'] == 'staff') {
                echo "Add Course";
            } else {
                echo "Enroll Course";
            }
        } else
            include_once '/system/php/error_page.php';
        ?>
    </button>
</form>