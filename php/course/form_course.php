<?php
require_once '../function/sql_cmds.php';
require_once '../function/run_query.php';
require_once '../function/check_profile.php';
require_once '../function/check_role.php';
require_once '../model/course.php';

if (session_status() == PHP_SESSION_NONE)
    session_start();

check_profile();
staff_only_page();

$conn = open_db();

$action = $_GET['action'] ?? 'add';
//If no url para given or otherwise, assume add by default
if ($action != 'edit' && $action != 'add')
    $action = 'add';

//There is no failed in editing before
//Then, fetch the data from db
if ($action == 'edit' && !isset($_SESSION["course"])) {
    if (!isset($_GET['course_id'])) {
        header("location: course_handler.php");
        exit;
    }

    $course_id = mysqli_real_escape_string($conn, $_GET["course_id"]);

    $sql = fetch_course_cmd($course_id);

    $res = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    if (mysqli_errno($conn) != 0)
        die(mysqli_error($conn));

    $course = Course::assoc_array_to_obj($res);

    unset($res);
}

//There are errors
if (isset($_SESSION["course"])) {
    //strip added slashes added by mysqli_real_escape_string
    //But preserve newline
    foreach ($_SESSION["course"] as &$val)
        $val = strip_tags(stripcslashes($val));

    $course = Course::assoc_array_to_obj($_SESSION['course']);

    unset($_SESSION['course']);
}

//To select current year
$year = date("Y");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php $action == 'add' ? print "Add" : print "Edit" ?> Course</title>
    <style>
        p {
            margin: 5px 0px 0px 0px !important;
        }

        button[type=submit] {
            float: right;
        }

        .content {
            width: fit-content;
            margin: auto;
        }
    </style>

    <link rel="stylesheet" href="../../css/template.css">

    <!-- <script src="../../js/check_exist.js"></script> -->
    <script src="../../js/course_validate.js"></script>
</head>

<body>
    <?php include_once '../../html/header.html'; ?>

    <div class="content">
        <h1 style="text-align: center"><?php echo ucfirst($action) ?></h1>
        <form action="<?php $action == 'add' ? print 'add_handler.php' : print "edit_handler.php?course_id={$course->id}" ?>" method="post" onsubmit="return check_if_no_error()">
            <fieldset>
                <legend>Course Info</legend>
                <p>Academic Years*</p>
                <input type="number" name="academic_y1" id="academic_y1" required value="<?php echo $course->academic_y1 ?? $year ?>">
                <label>to</label>
                <input type="number" name="academic_y2" id="academic_y2" required value="<?php echo $course->academic_y2 ?? $year + 1 ?>" onblur="validate_academic()">
                <p class="error" id="e_academic"><?php print $_SESSION['e_msg']['academic'] ?? '' ?></p>

                <p>Semester*</p>
                <select name="semester" id="semester" onblur="validate_semester()" required>
                    <?php
                    $selected = $course->semester ?? 1;
                    for ($i = 1; $i <= 8; ++$i) {
                        $selected_val = ($selected == $i ? 'selected' : '');
                        echo "<option value=\"$i\" $selected_val>$i</option>";
                    }
                    ?>
                </select>
                <p class="error" id="e_semester"><?php echo $_SESSION['e_msg']['semester'] ?? '' ?></p>

                <p>Course Name*</p>
                <input type="text" id="course_name" name="course_name" maxlength="255" required onblur="validate_course_name(<?php echo $course->id ?? -1 ?>)" value="<?php echo $course->course_name ?? '' ?>">
                <p class="error" id="e_course_name"><?php echo $_SESSION['e_msg']['course_name'] ?? '' ?></p>

                <p>Course Code*</p>
                <input type="text" id="course_code" name="course_code" maxlength="20" required onblur="validate_course_code(<?php echo $course->id ?? -1 ?>)" value="<?php echo $course->course_code ?? '' ?>">
                <p class="error" id="e_course_code"><?php echo $_SESSION['e_msg']['course_code'] ?? '' ?></p>

                <p>Course Group*</p>
                <select name="cg_id" id="cg_id" onblur="validate_cg_id()" required>
                    <?php
                    include_once '../model/course_group.php';
                    $cgId = $course->cg_id ?? 1;
                    for ($i = 1; $i <= 4; ++$i) {
                        $selected = ($cgId == $i ? "selected" : "");
                        echo "<option value=\"$i\" $selected>$cg_assoc[$i]</option>";
                    }
                    ?>
                </select>
                <p class="error" id="e_cg_id"><?php echo $_SESSION['e_msg']['cg_id'] ?? '' ?></p>

                <p>Course Description*</p>
                <textarea name="course_desc" maxlength="65535" rows="10" cols="42" onblur="validate_course_desc()" required><?php echo $course->course_desc ?? '' ?></textarea>
                <p class="error" id="e_course_desc"><?php echo $_SESSION['e_msg']['course_desc'] ?? '' ?></p>

                <button type="submit" name="submit">
                    <?php
                    echo ucfirst($_GET["action"]);
                    ?>
                </button>
            </fieldset>

        </form>
    </div>

    <?php include '../../html/footer.html'; ?>

    <?php
    if (isset($_SESSION['e_msg']))
        unset($_SESSION['e_msg']);
    ?>
</body>

</html>