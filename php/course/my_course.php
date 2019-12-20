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
    </thead>

    <tbody>
        <?php
        require_once 'php/function/run_query.php';

        if (isset($_SESSION['profile']['role'])) {
            $sql = "SELECT c.academic, c.semester, c.courseName, 
                            c.courseCode, cg.name AS courseGroup, c.courseDescription, 
                            user.fullName AS createdBy FROM course AS c
                            INNER JOIN course_group cg ON c.cgId = cg.id
                            INNER JOIN user ON c.createdBy = user.id;";

            $res = get_num($sql);

            foreach ($res as $course) {
                echo "<tr>";
                foreach ($course as $val)
                    echo "<td>$val</td>";
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