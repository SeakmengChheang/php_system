<?php

include "php/function/open_db.php";

function run_query($sql)
{
    $link = open_db();

    $result = mysqli_query($link, $sql);

    $link->close();
}

function get_assoc($sql)
{
    $link = open_db();

    $result = mysqli_query($link, $sql);

    $rtn = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $link->close();
    
    return $rtn;
}

function get_num($sql)
{
    $link = open_db();

    $result = mysqli_query($link, $sql);

    $rtn = mysqli_fetch_all($result, MYSQLI_NUM);

    $link->close();

    return $rtn;
}

?>