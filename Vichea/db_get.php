<?php

function open_db() {
    return mysqli_connect("localhost", "root", "", "system");
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
