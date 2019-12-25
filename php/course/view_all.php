<?php
require_once '../function/check_profile.php';
require_once '../function/run_query.php';
require_once '../function/sql_cmds.php';

check_profile();

//When user searches
if (isset($_GET['keyword']) && isset($_GET["option"])) {
    $option = htmlspecialchars($_GET["option"]);
    $keyword = htmlspecialchars($_GET["keyword"]);
    if ($option == 'all')
        $sql = search_all_fields($keyword);
    else
        $sql = search_by_cmd($_GET["keyword"], $_GET["option"]);

    //echo $sql;
}
//In normal view
else {
    $sql = fetch_all_courses_cmd();
}

$res = get_assoc($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>View All Courses</title>

    <link rel="stylesheet" href="../../css/table.css">
    <link rel="stylesheet" href="../../css/template.css">
</head>

<body>
    <?php include_once '../../html/header.html' ?>

    <div class="content">
        <div class="button-bar">
            <button>
                <a href="my_course.php">
                    <?php
                    $_SESSION['profile']['role'] == 'student'
                        ? print 'My Courses'
                        : print 'My Added Courses'; ?>
                </a>
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
            </thead>

            <tbody>
                <?php
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

        <form action="<?php $_SESSION['profile']['role'] == 'student'
                            ? print "enroll_course.php"
                            : print "form_course.php?action=add" ?>" method="POST">
            <button type="submit" name="submit">
                <?php
                $_SESSION['profile']['role'] == 'student'
                    ? print "Enroll Course"
                    : print "Add Course";
                ?>
            </button>
        </form>
    </div>

    <?php include_once '../../html/footer.html' ?>

</body>

</html>