<?php
$options = ['all' => 'All', 'academic' => 'Academic', 'semester' => 'Semester', 'course_name' => 'Course Name', 'course_code' => 'Course Code', 'course_group' => 'Course Group', 'course_desc' => 'Course Description', 'author' => 'Author'];

if (isset($sort_by_order)) {
    $sort_by_order_sel = $sort_by_order;
} else {
    $sort_by_order_sel = 'ASC';
}
?>

<script>
    function sort_by_onchange(e) {
        document.getElementById('submit').click();
    }
</script>

<div class="form">
    <form action="" method="GET">
        <label>Sort by:</label>
        <select name="sort_by" id="sort_by" onchange="sort_by_onchange()">
            <?php
            foreach ($options as $key => $val) {
                if ($key == 'all') continue;

                $selected = (isset($sort_by) and $sort_by == $key) ? 'selected' : '';
                echo "<option value='$key' $selected>$val</option>";
            }
            ?>
        </select>
        <select name="sort_by_order" id="sort_by_order" onchange="sort_by_onchange()">
            <option value="ASC" <?php if($sort_by_order_sel == 'ASC') echo 'selected' ?>>Ascending</option>
            <option value="DESC" <?php if($sort_by_order_sel == 'DESC') echo 'selected' ?>>Descending</option>
        </select>

        <input type="text" name="keyword" id="keyword" placeholder="Enter keyword to search..." size="70%" value="<?php if (isset($keyword)) echo stripslashes($keyword) ?>">

        <select name="option" id="option">
            <?php
            foreach ($options as $key => $val) {
                $selected = (isset($option) and $option == $key) ? 'selected' : '';
                echo "<option value='$key' $selected>$val</option>";
            }
            ?>
        </select>

        <button type="submit" name="submit" id="submit">
            Search
        </button>
    </form>
</div>