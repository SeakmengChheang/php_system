<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>

    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/table.css">
</head>

<body>
    <div class="navbar">
        <img src="images/logo.png" alt="piu-logo" height="75px" width="250px">

        <div class="menu">
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="">Course</a></li>
                <li><a href="">Contact</a></li>
                <li><a href="">Profile</a></li>
                <li><a href="">Log out</a></li>
            </ul>
        </div>
    </div>

    <div class="body">
        <?php include 'course_handler.php'; ?>
    </div>

    <div class="footer">
        <p>Copyright &copy; Paragon IU 2019</p>
    </div>
</body>

</html>