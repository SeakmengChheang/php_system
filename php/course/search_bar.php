<div class="form">
    <form action="" method="GET">
        <input type="text" name="keyword" id="keyword" placeholder="Enter keyword to search..." size="70%" required value="<?php if (isset($keyword)) echo $keyword ?>">

        <select name="option" id="option">
            <?php
            $options = ['all' => 'All', 'academic' => 'Academic', 'semester' => 'Semester', 'course_name' => 'Course Name', 'course_code' => 'Course Code', 'course_group' => 'Course Group', 'course_desc' => 'Course Description', 'author' => 'Author'];

            foreach ($options as $key => $val) {
                $selected = (isset($option) and $option == $key) ? 'selected' : '';
                echo "<option value='$key' $selected>$val</option>";
            }
            ?>
        </select>

        <button type="submit">
            Search
        </button>
    </form>
</div>