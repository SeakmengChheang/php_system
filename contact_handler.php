<?php
include "php/function/check_profile.php";

if (session_status() == PHP_SESSION_NONE)
    session_start();

check_profile();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Contact</title>

    <link rel="stylesheet" href="css/template.css">
    <link rel="stylesheet" href="css/table.css">
</head>

<body>
    <?php include 'html/header.html' ?>

    <div class="content">
        <div class="button-bar">
            <button>View All</button>
            <button><?php if (isset($_SESSION['profile']['role']))
                        print "View All";
                    else include 'php/error_page.php'; ?></button>
        </div>

        <table>
            <thead>
                <th>ID</th>
                <th>Full Name</th>
                <th>Role</th>
                <?php
                if (isset($_SESSION['profile']['role'])) {
                    if ($_SESSION['profile']['role'] == 'staff')
                        echo "<th>Position</th>";
                }
                ?>

            </thead>

            <tbody>
                <?php
                include_once 'php/function/db_get.php';

                if (isset($_SESSION['profile']['role'])) {
                    //IF role is staff then also fetch POSITION
                    $sql = "SELECT user.id, user.fullName, user.role" .
                        ($_SESSION['profile']['role'] == 'staff'
                            ? ", staff.position FROM user  INNER JOIN staff ON user.id = staff.id"
                            : " FROM user");

                    $res = get_num($sql);

                    foreach ($res as $user) {
                        echo "<tr>";
                        foreach ($user as $val)
                            echo "<td>$val</td>";
                        echo "</tr>";
                    }
                } else {
                    include 'php/error_page.php';
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php include 'html/footer.html' ?>

</body>

</html>