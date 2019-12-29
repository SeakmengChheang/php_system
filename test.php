<?php

    $con = mysqli_connect("localhost","root","","system");
    $blah = $_GET["blah"];

    $blah = mysqli_real_escape_string($con , $blah);
    $blah = stripslashes($blah);


    echo $blah;

?>

