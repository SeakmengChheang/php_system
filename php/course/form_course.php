<?php
include_once '/system/php/function/check_profile.php';
include_once '/system/php/function/sql_cmds.php';
include_once '/system/php/function/run_query.php';

check_profile();

if (!isset($_GET['action']))
    header("location: /system/course_handler.php");

if ($_GET['action'] == 'edit') {
    if (!isset($_GET['course_id']))
        header("location: /system/course_handler.php");

    $sql = fetch_course_cmd($_GET['course_id']);

    $c = get_assoc($sql);

    //There's only one course from db
    $_SESSION['course'] = $c[0];
} elseif ($_GET['action'] == 'add') {
    //TODO: What to do?
} else {
    header("location: /system/course_handler.php");
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

    <link rel="stylesheet" href="/system/css/template.css">
</head>

<body>
    <?php include_once '/system/html/header.html'; ?>

    <div class="content">
        <form action="/system/php/course/<?php $_GET['action'] == 'add' ? print 'add_handler.php' : print "edit_handler.php?course_id={$_SESSION['course']['id']}" ?>" method="post">
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
                    include_once '/system/php/model/course_group.php';
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

                <button type="submit" name="submit">Add</button>
            </fieldset>

        </form>
    </div>

    <?php include '/system/html/footer.html'; ?>


    <?php
    if (isset($_SESSION['course']))
        unset($_SESSION['course']);

    if (isset($_SESSION['e_msg']))
        unset($_SESSION['e_msg']);
    ?>
</body>

</html>