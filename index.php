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
        function check_profile(){
            if(!isset($_SESSION['profile'])) {
                header("location: login.php");
            }
        }
        check_profile();
    ?>

    
    
    <!-- <div class="body">

    </div> -->
    
    
    
</body>

</html>