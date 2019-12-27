<?php
require_once '../function/check_profile.php';
require_once '../function/run_query.php';
require_once '../function/sql_cmds.php';
require_once '../function/sanitize_string.php';

check_profile();

$conn = open_db();

//When user searches
if (isset($_GET['keyword']) && isset($_GET["option"])) {
    $option = sanitize_string($conn, $_GET["option"]);
    $keyword = sanitize_string($conn, $_GET["keyword"]);
    if ($option == 'all')
        $sql = search_all_fields($keyword);
    else
        $sql = search_by_cmd($keyword, $option);
}
//In normal view
else {
    $sql = fetch_all_courses_cmd();
}

if (isset($_GET["sort_by"])) {
    $sort_by = sanitize_string($conn, $_GET["sort_by"]);
    $sql .= " ORDER BY $sort_by";
} else {
    $sql .= " ORDER BY academic";
}

if (isset($_GET["sort_by_order"]))
    $sort_by_order = sanitize_string($conn, $_GET["sort_by_order"]);
else
    $sort_by_order = 'ASC';
$sql .= ' ' . $sort_by_order;

$courses = mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);

if(mysqli_errno($conn) != 0)
    die(mysqli_error($conn));

mysqli_close($conn);
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
                foreach ($courses as $course) {
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