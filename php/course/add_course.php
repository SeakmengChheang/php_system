<?php
if(isset($_POST['submit'])) echo 'hello';

include_once 'php/model/course_group.php';

function add_year_options($start, $end, $selected_val) {
    for($i = $start; $i < $end; ++$i) {
        $selected = $i == $selected_val ? "selected" : "";
        echo "<option value=\"$i\" $selected >$i</option>";
    }
}
?>

<style>
    p {
        margin: 5px 0px 0px 0px !important;
    }
</style>

<form action="" method="post">
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
        <select name="courseGroup">
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

<script>
    
</script>