<?php

include_once "open_db.php";

function run_query($sql)
{
    $link = open_db();

    $result = mysqli_query($link, $sql) or die(mysqli_error($link));

    $link->close();

    return $result;
}

function get_assoc($sql)
{
    $link = open_db();

    $result = mysqli_query($link, $sql) or die(mysqli_error($link));

    $rtn = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $link->close();
    
    return $rtn;
}

function get_num($sql)
{
    $link = open_db();

    $result = mysqli_query($link, $sql) or die(mysqli_error($link));

    $rtn = mysqli_fetch_all($result, MYSQLI_NUM);

    $link->close();

    return $rtn;
}

function get_row($sql) {
    $link = open_db();

    $result = mysqli_query($link, $sql) or die(mysqli_error($link));

    $rtn = mysqli_fetch_row($result);

    $link->close();

    return $rtn;
}

?>