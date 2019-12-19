<!DOCTYPE html>
<html lang="en">

<head>
    <title>Course</title>

    <link rel="stylesheet" href="css/template.css">
</head>

<body>
    <?php include 'html/header.html' ?>;

    <?php session_start(); ?>

    <div>
        <div class="button-bar">
            <button><?php if (isset($_SESSION['role'])) $_SESSION['role'] == 'student'
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
                <?php
                if (isset($_SESSION['role']) && $_SESSION['role'] == 'student')
                    echo "<th>Author</th>";
                ?>

            </thead>

            <tbody>
                <?php
                if (isset($_SESSION['role'])) {
                    if ($_SESSION['role'] == 'student')
                        include 'php/course/my_course.php';
                    else
                        include 'php/course/my_added_course.php';
                } else {
                    include 'php/error_page.php';
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php include 'html/footer.html' ?>
</body>

</html>