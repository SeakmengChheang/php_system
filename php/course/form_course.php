<?php
include_once '../function/sql_cmds.php';
include_once '../function/run_query.php';
include_once '../function/check_profile.php';
include_once '../function/check_role.php';

if (session_status() == PHP_SESSION_NONE)
    session_start();

check_profile();
staff_only_page();

// if (!isset($_GET['action']))
//     header("location: ../../course_handler.php");

if ($_GET['action'] == 'edit') {
    //There is no failed in editing before
    //Then, fetch the data from db
    if (!isset($_SESSION["course"])) {
        if (!isset($_GET['course_id']))
            header("location: course_handler.php");

        $course_id = htmlspecialchars($_GET["course_id"]);
        $sql = fetch_course_cmd($course_id);

        $course = get_assoc($sql);
        print_r($course);

        //There's only one course from db
        $_SESSION['course'] = $course[0];
    }
}
//If no url para given, assume add default
elseif ($_GET['action'] != 'add') {
    $_GET["action"] = 'add';
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

        .error {
            color: darkred;
        }
    </style>

    <link rel="stylesheet" href="../../css/template.css">
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
                <input type="number" name="academic_y2" id="academic_y2" value="<?php isset($_SESSION['course']['academic']) ? print explode('-', $_SESSION['course']['academic'])[1] : print $year + 1 ?>" required>
                <p class="error"><?php isset($_SESSION['e_msg']['academic']) ? print $_SESSION['e_msg']['academic'] : print '' ?></p>

                <p>Semester*</p>
                <select name="semester" required>
                    <?php
                    $selected = 1;
                    if (isset($_SESSION['course']['semester']))
                        $selected = $_SESSION['course']['semester'];
                    for ($i = 1; $i <= 8; ++$i) {
                        $selected_val = ($selected == $i ? 'selected' : '');
                        echo "<option value=\"$i\" $selected_val>$i</option>";
                    }
                    ?>
                </select>
                <p class="error"><?php isset($_SESSION['e_msg']['semester']) ? print $_SESSION['e_msg']['semester'] : print '' ?></p>

                <p>Course Name*</p>
                <input type="text" name="course_name" required value="<?php if (isset($_SESSION['course']['course_name'])) echo $_SESSION['course']['course_name'] ?>">
                <p class="error"><?php isset($_SESSION['e_msg']['course_name']) ? print $_SESSION['e_msg']['course_name'] : print '' ?></p>

                <p>Course Code*</p>
                <input type="text" name="course_code" required value="<?php if (isset($_SESSION['course']['course_code'])) echo $_SESSION['course']['course_code'] ?>">
                <p class="error"><?php isset($_SESSION['e_msg']['course_code']) ? print $_SESSION['e_msg']['course_code'] : print '' ?></p>

                <p>Course Group*</p>
                <select name="cg_id" required>
                    <?php
                    include_once '../model/course_group.php';
                    if (isset($_SESSION['course']['cg_id'])) $cgId = $_SESSION['course']['cg_id'];
                    for ($i = 1; $i <= 4; ++$i) {
                        $selected = ($cgId == $i ? "selected" : "");
                        echo "<option value=\"$i\" $selected>$cg_assoc[$i]</option>";
                    }
                    ?>
                </select>
                <p class="error"><?php isset($_SESSION['e_msg']['cg_id']) ? print $_SESSION['e_msg']['cg_id'] : print '' ?></p>

                <p>Course Description*</p>
                <textarea name="course_desc" cols="30" rows="10" required><?php if (isset($_SESSION['course']['course_desc'])) echo $_SESSION['course']['course_desc'] ?></textarea> <br>
                <p class="error"><?php isset($_SESSION['e_msg']['course_desc']) ? print $_SESSION['e_msg']['course_desc'] : print '' ?></p>

                <button type="submit" name="submit">
                    <?php
                    $_GET["action"] == 'add' ? print 'Add' : print 'Edit';
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