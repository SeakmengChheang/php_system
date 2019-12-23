<?php

function check_staff_only() {
    if($_SESSION['profile']['role'] != 'staff') {
        header("location: /system/index.php");
    }
}