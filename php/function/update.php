<?php

include "php/function/open_db.php";

function update($sql)
{
    $link = open_db();

    $result = mysqli_query($link, $sql);

    $link->close();
}


?>