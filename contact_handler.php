<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact</title>

    <link rel="stylesheet" href="css/template.css">
    <link rel="stylesheet" href="css/table.css">
</head>
<body>
<?php include 'html/header.html' ?>

<?php session_start(); ?>

<div>
    <div class="button-bar">
        <button><?php if (isset($_SESSION['role'])) {
                    $_SESSION['role'] == 'student'
                        ? print 'My Course'
                        : print 'Added Courses';
                } else include 'php/error_page.php'; ?></button>
        <button>View All</button>
    </div>

    <table>
        <thead>
            <th>ID</th>
            <th>Full Name</th>
            <th>Role</th>
            <?php
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 'student')
                    echo "<th>Position</th>";
            } else {
                //TODO: 
            }
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
                //TODO: 
                include 'php/error_page.php';
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'html/footer.html' ?>

</body>
</html>