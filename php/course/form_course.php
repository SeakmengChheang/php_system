<?php
require_once '../function/sql_cmds.php';
require_once '../function/run_query.php';
require_once '../function/check_profile.php';
require_once '../function/check_role.php';
require_once '../function/mysqli_real_escape_string.php';

if (session_status() == PHP_SESSION_NONE)
    session_start();

check_profile();
staff_only_page();

$conn = open_db();

if ($_GET['action'] == 'edit') {
    //There is no failed in editing before
    //Then, fetch the data from db
    if (!isset($_SESSION["course"])) {
        if (!isset($_GET['course_id'])) {
            header("location: course_handler.php");
            die();
        }

        $course_id = mysqli_real_escape_string($conn, $_GET["course_id"]);

        $sql = fetch_course_cmd($course_id);

        $course = mysqli_fetch_assoc(mysqli_query($conn, $sql));

        if (mysqli_errno($conn) != 0)
            die(mysqli_error($conn));

        //There's only one course from db
        $_SESSION['course'] = $course;
    }
}
//If no url para given, assume add by default
elseif ($_GET['action'] != 'add') {
    $_GET["action"] = 'add';
}

if (isset($_SESSION["course"])) {
    echo $_SESSION["course"]['course_desc'];
    $_SESSION["course"]['course_desc'] = nl2br($_SESSION["course"]["course_desc"]);
    echo $_SESSION["course"]['course_desc'];
    
    //strip added slashes added by mysqli_real_escape_string
    foreach ($_SESSION["course"] as &$val)
        $val = stripslashes($val);
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
    <title><?php $_GET['action'] == 'add' ? print "Add" : print "Edit" ?> Course</title>
    <style>
        p {
            margin: 5px 0px 0px 0px !important;
        }
        input[type=text] {
            width: 350px;
        }

        button[type=submit] {
            float: right;
        }
    </style>

    <link rel="stylesheet" href="../../css/template.css">
    <style>
        .content {
            display: inline-block;
            vertical-align: middle;
            width: max-content;
        }
    </style>
</head>

<body>
    <?php include_once '../../html/header.html'; ?>

    <div class="content">
        <form action="<?php $_GET['action'] == 'add' ? print 'add_handler.php' : print "edit_handler.php?course_id={$_SESSION['course']['id']}" ?>" method="post">
            <fieldset>
                <legend>Course Info</legend>
                <p>Academic Years*</p>
                <input type="number" name="academic_y1" id="academic_y1" required value="<?php isset($_SESSION['course']['academic']) ? print explode('-', $_SESSION['course']['academic'])[0] : print $year ?>">
                <label>to</label>
                <input type="number" name="academic_y2" id="academic_y2" required value="<?php isset($_SESSION['course']['academic']) ? print explode('-', $_SESSION['course']['academic'])[1] : print $year + 1 ?>">
                <p class="error"><?php print $_SESSION['e_msg']['academic'] ?? '' ?></p>

                <p>Semester*</p>
                <select name="semester" required>
                    <?php
                    $selected = $_SESSION['course']['semester'] ?? 1;
                    for ($i = 1; $i <= 8; ++$i) {
                        $selected_val = ($selected == $i ? 'selected' : '');
                        echo "<option value=\"$i\" $selected_val>$i</option>";
                    }
                    ?>
                </select>
                <p class="error"><?php echo $_SESSION['e_msg']['semester'] ?? '' ?></p>

                <p>Course Name*</p>
                <input type="text" id="course_name" name="course_name" required value="<?php echo $_SESSION['course']['course_name'] ?? '' ?>">
                <p class="error"><?php echo $_SESSION['e_msg']['course_name'] ?? '' ?></p>

                <p>Course Code*</p>
                <input type="text" id="course_code" name="course_code" required value="<?php echo $_SESSION['course']['course_code'] ?? '' ?>">
                <p class="error"><?php echo $_SESSION['e_msg']['course_code'] ?? '' ?></p>

                <p>Course Group*</p>
                <select name="cg_id" required>
                    <?php
                    include_once '../model/course_group.php';
                    $cgId = $_SESSION['course']['cg_id'] ?? 1;
                    for ($i = 1; $i <= 4; ++$i) {
                        $selected = ($cgId == $i ? "selected" : "");
                        echo "<option value=\"$i\" $selected>$cg_assoc[$i]</option>";
                    }
                    ?>
                </select>
                <p class="error"><?php echo $_SESSION['e_msg']['cg_id'] ?? '' ?></p>

                <p>Course Description*</p>
                <textarea name="course_desc" rows="10" cols="40" required><?php echo $_SESSION['course']['course_desc'] ?? '' ?></textarea>
                <p class="error"><?php echo $_SESSION['e_msg']['course_desc'] ?? '' ?></p>

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
    if (isset($_SESSION['course']))
        unset($_SESSION['course']);

    if (isset($_SESSION['e_msg']))
        unset($_SESSION['e_msg']);
    ?>
</body>

</html>