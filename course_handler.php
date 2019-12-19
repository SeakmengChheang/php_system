<!DOCTYPE html>
<html lang="en">

<head>
    <title>Course</title>

    <link rel="stylesheet" href="css/template.css">
    <link rel="stylesheet" href="css/table.css">
</head>

<body>
    <?php include 'html/header.html' ?>;

    <?php session_start(); ?>

    <div>
        <div class="button-bar">
            <button><?php if (isset($_SESSION['profile']['role']))
                        $_SESSION['profile']['role'] == 'student'
                            ? print 'My Course'
                            : print 'Added Courses';
                    else print 'N/A'; ?></button>
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
                require 'php/function/db_get.php';
                echo "<pre>";
                print_r($_SESSION['profile']);

                if (isset($_SESSION['profile']['role'])) {
                    $sql = "SELECT c.academic, c.semester, c.courseName, 
                            c.courseCode, cg.name AS courseGroup, c.courseDescription, 
                            user.fullName AS createdBy FROM course AS c
                            INNER JOIN course_group cg ON c.cgId = cg.id
                            INNER JOIN user ON c.createdBy = user.id;";

                    $res = get_num($sql);

                    print_r($res);
                    
                    foreach ($res as $course) {
                        echo "<tr>";
                        foreach ($course as $val)
                            echo "<td>$val</td>";
                        echo "</tr>";
                    }
                } else {
                    include 'php/error_page.php';
                }
                echo "</pre>";
                ?>
            </tbody>
        </table>
    </div>

    <?php include 'html/footer.html' ?>
</body>

</html>