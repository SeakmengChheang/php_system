<?php
include_once '/system/php/model/course_group.php';
if (session_status() == PHP_SESSION_NONE)
    session_start();

if (isset($_SESSION['error_msg']))
    echo $_SESSION['error_msg'];

function add_year_options($start, $end, $selected_val)
{
    for ($i = $start; $i < $end; ++$i) {
        $selected = $i == $selected_val ? "selected" : "";
        echo "<option value=\"$i\" $selected >$i</option>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Course</title>
    <style>
        p {
            margin: 5px 0px 0px 0px !important;
        }
    </style>
</head>

<body>
    <?php include '/system/html/header.html'; ?>

    <div class="content">
        <form action="/system/php/course/add_handler.php" method="post">
            <fieldset>
                <legend>Course Info</legend>
                <p>Academic: </p>
                <select name="academic_y1">
                    <?php
                    $year = date("Y");

                    add_year_options($year - 4, $year + 6, $year);
                    ?>
                </select>
                <label>to</label>
                <select name="academic_y2">
                    <?php
                    $year = date("Y");

                    add_year_options($year - 3, $year + 7, $year + 1);
                    ?>
                </select>

                <p>Semester: </p>
                <select name="semester">
                    <?php
                    for ($i = 1; $i <= 8; ++$i)
                        echo "<option value=\"$i\">$i</option>";
                    ?>
                </select>

                <p>Course Name: </p>
                <input type="text" name="courseName">

                <p>Course Code: </p>
                <input type="text" name="courseCode">

                <p>Course Group: </p>
                <select name="courseGroupId">
                    <?php
                    for ($i = 1; $i <= 4; ++$i)
                        echo "<option value=\"$i\">$cg_assoc[$i]</option>";
                    ?>
                </select>

                <p>Course Description: </p>
                <textarea name="courseDesc" cols="30" rows="10"></textarea> <br>

                <button type="submit" name="submit">Add</button>
            </fieldset>

        </form>
    </div>

    <?php include '/system/html/footer.html'; ?>
</body>

</html>