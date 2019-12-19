<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>

    <link rel="stylesheet" href="css/template.css">
    <link rel="stylesheet" href="css/table.css">
</head>

<body>
    <?php
        session_start();
        if(!isset($_SESSION['profile'])) {
            header("location: login.php");
        }
    ?>

    <?php include 'html/header.html'; ?>
    
    <div class="body">

    </div>
    
    <?php include 'html/footer.html'; ?>
    
</body>

</html>