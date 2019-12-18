<?php session_start(); ?>

<div>
    <div class="button-bar">
        <button><?php $_SESSION['role'] == 'student'
                    ? print 'My Course'
                    : print 'Added Courses' ?></button>
        <button>View All</button>
    </div>

    <table>
        <thead>
            <th>Academic</th>
            <th>Semester</th>
            <th>Course Name</th>
            <th>Course Code</th>
            <th>Course Group</th>
            <th>Course Description</th>
            <th>Author</th>
            <?php
                if($_SESSION['role'] == 'student')
                    echo "<th>Author</th>";
            ?>
            
        </thead>

        <tbody>

        </tbody>
    </table>
</div>